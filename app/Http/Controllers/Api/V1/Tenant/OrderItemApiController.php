<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreOrderItemRequest;
use App\Http\Requests\Tenant\UpdateOrderItemRequest;
use App\Http\Resources\Tenant\OrderItemResource;
use App\Models\OrderItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderItemResource(OrderItem::with(['order', 'product', 'color', 'size', 'variation'])->get());
    }

    public function store(StoreOrderItemRequest $request)
    {
        $orderItem = OrderItem::create($request->all());

        return (new OrderItemResource($orderItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderItemResource($orderItem->load(['order', 'product', 'color', 'size', 'variation']));
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return (new OrderItemResource($orderItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
