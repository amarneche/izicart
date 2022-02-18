<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyWilayaRequest;
use App\Http\Requests\Tenant\StoreWilayaRequest;
use App\Http\Requests\Tenant\UpdateWilayaRequest;
use App\Models\PaymentMethod;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WilayaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wilaya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::with(['payment_methods'])->get();

        return view('tenant.wilayas.index', compact('wilayas'));
    }

    public function create()
    {
        abort_if(Gate::denies('wilaya_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment_methods = PaymentMethod::pluck('title', 'id');

        return view('tenant.wilayas.create', compact('payment_methods'));
    }

    public function store(StoreWilayaRequest $request)
    {
        $wilaya = Wilaya::create($request->all());
        $wilaya->payment_methods()->sync($request->input('payment_methods', []));

        return redirect()->route('tenant.wilayas.index');
    }

    public function edit(Wilaya $wilaya)
    {
        abort_if(Gate::denies('wilaya_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment_methods = PaymentMethod::pluck('title', 'id');

        $wilaya->load('payment_methods');

        return view('tenant.wilayas.edit', compact('payment_methods', 'wilaya'));
    }

    public function update(UpdateWilayaRequest $request, Wilaya $wilaya)
    {
        $wilaya->update($request->all());
        $wilaya->payment_methods()->sync($request->input('payment_methods', []));

        return redirect()->route('tenant.wilayas.index');
    }

    public function show(Wilaya $wilaya)
    {
        abort_if(Gate::denies('wilaya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilaya->load('payment_methods', 'wilayaCommunes', 'wilayaPaymentMethods', 'shipToWilayasDeliveryCompanies');

        return view('tenant.wilayas.show', compact('wilaya'));
    }

    public function destroy(Wilaya $wilaya)
    {
        abort_if(Gate::denies('wilaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilaya->delete();

        return back();
    }

    public function massDestroy(MassDestroyWilayaRequest $request)
    {
        Wilaya::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
