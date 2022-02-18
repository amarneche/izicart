<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyOrderItemRequest;
use App\Http\Requests\Tenant\StoreOrderItemRequest;
use App\Http\Requests\Tenant\UpdateOrderItemRequest;
use App\Models\ColorAttribute;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SizeAttribute;
use App\Models\VariationAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItems = OrderItem::with(['order', 'product', 'color', 'size', 'variation'])->get();

        return view('tenant.orderItems.index', compact('orderItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('order_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = ColorAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = SizeAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = VariationAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.orderItems.create', compact('colors', 'orders', 'products', 'sizes', 'variations'));
    }

    public function store(StoreOrderItemRequest $request)
    {
        $orderItem = OrderItem::create($request->all());

        return redirect()->route('tenant.order-items.index');
    }

    public function edit(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('order_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = ColorAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = SizeAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = VariationAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderItem->load('order', 'product', 'color', 'size', 'variation');

        return view('tenant.orderItems.edit', compact('colors', 'orderItem', 'orders', 'products', 'sizes', 'variations'));
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return redirect()->route('tenant.order-items.index');
    }

    public function show(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->load('order', 'product', 'color', 'size', 'variation');

        return view('tenant.orderItems.show', compact('orderItem'));
    }

    public function destroy(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderItemRequest $request)
    {
        OrderItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
