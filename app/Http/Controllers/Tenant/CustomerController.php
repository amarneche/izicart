<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyCustomerRequest;
use App\Http\Requests\Tenant\StoreCustomerRequest;
use App\Http\Requests\Tenant\UpdateCustomerRequest;
use App\Models\Commune;
use App\Models\Customer;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::with(['wilaya', 'commune'])->get();

        return view('tenant.customers.index', compact('customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id')->prepend(trans('global.pleaseSelect'), '');

        $communes = Commune::pluck('commune', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.customers.create', compact('communes', 'wilayas'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return redirect()->route('tenant.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id')->prepend(trans('global.pleaseSelect'), '');

        $communes = Commune::pluck('commune', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customer->load('wilaya', 'commune');

        return view('tenant.customers.edit', compact('communes', 'customer', 'wilayas'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('tenant.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('wilaya', 'commune');

        return view('tenant.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerRequest $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
