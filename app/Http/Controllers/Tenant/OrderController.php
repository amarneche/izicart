<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyOrderRequest;
use App\Http\Requests\Tenant\StoreOrderRequest;
use App\Http\Requests\Tenant\UpdateOrderRequest;
use App\Models\Commune;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['customer', 'ship_to_wilaya', 'shipt_to_commune', 'payment_method'])->get();

        return view('tenant.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_wilayas = Wilaya::pluck('wilaya', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipt_to_communes = Commune::pluck('commune', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.orders.create', compact('customers', 'payment_methods', 'ship_to_wilayas', 'shipt_to_communes'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('tenant.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_wilayas = Wilaya::pluck('wilaya', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipt_to_communes = Commune::pluck('commune', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('customer', 'ship_to_wilaya', 'shipt_to_commune', 'payment_method');

        return view('tenant.orders.edit', compact('customers', 'order', 'payment_methods', 'ship_to_wilayas', 'shipt_to_communes'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('tenant.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'ship_to_wilaya', 'shipt_to_commune', 'payment_method', 'orderOrderItems');

        return view('tenant.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
