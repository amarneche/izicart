<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyPaymentMethodRequest;
use App\Http\Requests\Tenant\StorePaymentMethodRequest;
use App\Http\Requests\Tenant\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethods = PaymentMethod::with(['wilayas', 'media'])->get();

        return view('tenant.paymentMethods.index', compact('paymentMethods'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id');

        return view('tenant.paymentMethods.create', compact('wilayas'));
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $paymentMethod = PaymentMethod::create($request->all());
        $paymentMethod->wilayas()->sync($request->input('wilayas', []));
        if ($request->input('photo', false)) {
            $paymentMethod->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $paymentMethod->id]);
        }

        return redirect()->route('tenant.payment-methods.index');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id');

        $paymentMethod->load('wilayas');

        return view('tenant.paymentMethods.edit', compact('paymentMethod', 'wilayas'));
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

        return redirect()->route('tenant.payment-methods.index');
    }

    public function show(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethod->load('wilayas', 'paymentMethodsWilayas');

        return view('tenant.paymentMethods.show', compact('paymentMethod'));
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies('payment_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentMethodRequest $request)
    {
        PaymentMethod::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('payment_method_create') && Gate::denies('payment_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PaymentMethod();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
