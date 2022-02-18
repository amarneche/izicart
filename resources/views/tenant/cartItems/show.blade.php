@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cartItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.cart-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.id') }}
                        </th>
                        <td>
                            {{ $cartItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.cart') }}
                        </th>
                        <td>
                            {{ $cartItem->cart->cart_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.product') }}
                        </th>
                        <td>
                            {{ $cartItem->product->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.quanitty') }}
                        </th>
                        <td>
                            {{ $cartItem->quanitty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.product_price') }}
                        </th>
                        <td>
                            {{ $cartItem->product_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.color') }}
                        </th>
                        <td>
                            {{ $cartItem->color->value ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.size') }}
                        </th>
                        <td>
                            {{ $cartItem->size->value ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cartItem.fields.variation') }}
                        </th>
                        <td>
                            {{ $cartItem->variation->value ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.cart-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection