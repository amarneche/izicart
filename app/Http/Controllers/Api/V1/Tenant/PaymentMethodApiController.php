<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StorePaymentMethodRequest;
use App\Http\Requests\Tenant\UpdatePaymentMethodRequest;
use App\Http\Resources\Tenant\PaymentMethodResource;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentMethodResource(PaymentMethod::with(['wilayas'])->get());
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $paymentMethod = PaymentMethod::create($request->all());
        $paymentMethod->wilayas()->sync($request->input('wilayas', []));
        if ($request->input('photo', false)) {
            $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new PaymentMethodResource($paymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentMethodResource($paymentMethod->load(['wilayas']));
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->all());
        $paymentMethod->wilayas()->sync($request->input('wilayas', []));
        if ($request->input('photo', false)) {
            if (!$paymentMethod->photo || $request->input('photo') !== $paymentMethod->photo->file_name) {
                if ($paymentMethod->photo) {
                    $paymentMethod->photo->delete();
                }
                $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($paymentMethod->photo) {
            $paymentMethod->photo->delete();
        }

        return (new PaymentMethodResource($paymentMethod))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
