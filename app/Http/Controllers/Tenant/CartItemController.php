<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyCartItemRequest;
use App\Http\Requests\Tenant\StoreCartItemRequest;
use App\Http\Requests\Tenant\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ColorAttribute;
use App\Models\Product;
use App\Models\SizeAttribute;
use App\Models\VariationAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cart_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cartItems = CartItem::with(['cart', 'product', 'color', 'size', 'variation'])->get();

        return view('tenant.cartItems.index', compact('cartItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('cart_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carts = Cart::pluck('cart_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = ColorAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = SizeAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = VariationAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.cartItems.create', compact('carts', 'colors', 'products', 'sizes', 'variations'));
    }

    public function store(StoreCartItemRequest $request)
    {
        $cartItem = CartItem::create($request->all());

        return redirect()->route('tenant.cart-items.index');
    }

    public function edit(CartItem $cartItem)
    {
        abort_if(Gate::denies('cart_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carts = Cart::pluck('cart_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = ColorAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = SizeAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variations = VariationAttribute::pluck('value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cartItem->load('cart', 'product', 'color', 'size', 'variation');

        return view('tenant.cartItems.edit', compact('cartItem', 'carts', 'colors', 'products', 'sizes', 'variations'));
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        $cartItem->update($request->all());

        return redirect()->route('tenant.cart-items.index');
    }

    public function show(CartItem $cartItem)
    {
        abort_if(Gate::denies('cart_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cartItem->load('cart', 'product', 'color', 'size', 'variation');

        return view('tenant.cartItems.show', compact('cartItem'));
    }

    public function destroy(CartItem $cartItem)
    {
        abort_if(Gate::denies('cart_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cartItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyCartItemRequest $request)
    {
        CartItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
