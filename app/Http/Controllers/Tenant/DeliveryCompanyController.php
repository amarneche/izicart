<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyDeliveryCompanyRequest;
use App\Http\Requests\Tenant\StoreDeliveryCompanyRequest;
use App\Http\Requests\Tenant\UpdateDeliveryCompanyRequest;
use App\Models\DeliveryCompany;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DeliveryCompanyController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('delivery_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryCompanies = DeliveryCompany::with(['ship_to_wilayas', 'media'])->get();

        return view('tenant.deliveryCompanies.index', compact('deliveryCompanies'));
    }

    public function create()
    {
        abort_if(Gate::denies('delivery_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ship_to_wilayas = Wilaya::pluck('wilaya', 'id');

        return view('tenant.deliveryCompanies.create', compact('ship_to_wilayas'));
    }

    public function store(StoreDeliveryCompanyRequest $request)
    {
        $deliveryCompany = DeliveryCompany::create($request->all());
        $deliveryCompany->ship_to_wilayas()->sync($request->input('ship_to_wilayas', []));
        if ($request->input('logo', false)) {
            $deliveryCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $deliveryCompany->id]);
        }

        return redirect()->route('tenant.delivery-companies.index');
    }

    public function edit(DeliveryCompany $deliveryCompany)
    {
        abort_if(Gate::denies('delivery_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ship_to_wilayas = Wilaya::pluck('wilaya', 'id');

        $deliveryCompany->load('ship_to_wilayas');

        return view('tenant.deliveryCompanies.edit', compact('deliveryCompany', 'ship_to_wilayas'));
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

        return redirect()->route('tenant.delivery-companies.index');
    }

    public function show(DeliveryCompany $deliveryCompany)
    {
        abort_if(Gate::denies('delivery_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryCompany->load('ship_to_wilayas');

        return view('tenant.deliveryCompanies.show', compact('deliveryCompany'));
    }

    public function destroy(DeliveryCompany $deliveryCompany)
    {
        abort_if(Gate::denies('delivery_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeliveryCompanyRequest $request)
    {
        DeliveryCompany::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('delivery_company_create') && Gate::denies('delivery_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DeliveryCompany();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
