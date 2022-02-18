<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreDeliveryCompanyRequest;
use App\Http\Requests\Tenant\UpdateDeliveryCompanyRequest;
use App\Http\Resources\Tenant\DeliveryCompanyResource;
use App\Models\DeliveryCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryCompanyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('delivery_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryCompanyResource(DeliveryCompany::with(['ship_to_wilayas'])->get());
    }

    public function store(StoreDeliveryCompanyRequest $request)
    {
        $deliveryCompany = DeliveryCompany::create($request->all());
        $deliveryCompany->ship_to_wilayas()->sync($request->input('ship_to_wilayas', []));
        if ($request->input('logo', false)) {
            $deliveryCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new DeliveryCompanyResource($deliveryCompany))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DeliveryCompany $deliveryCompany)
    {
        abort_if(Gate::denies('delivery_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryCompanyResource($deliveryCompany->load(['ship_to_wilayas']));
    }

    public function update(UpdateDeliveryCompanyRequest $request, DeliveryCompany $deliveryCompany)
    {
        $deliveryCompany->update($request->all());
        $deliveryCompany->ship_to_wilayas()->sync($request->input('ship_to_wilayas', []));
        if ($request->input('logo', false)) {
            if (!$deliveryCompany->logo || $request->input('logo') !== $deliveryCompany->logo->file_name) {
                if ($deliveryCompany->logo) {
                    $deliveryCompany->logo->delete();
                }
                $deliveryCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($deliveryCompany->logo) {
            $deliveryCompany->logo->delete();
        }

        return (new DeliveryCompanyResource($deliveryCompany))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeliveryCompany $deliveryCompany)
    {
        abort_if(Gate::denies('delivery_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryCompany->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
