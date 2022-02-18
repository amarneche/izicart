@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cartItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.cart-items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cart_id">{{ trans('cruds.cartItem.fields.cart') }}</label>
                <select class="form-control select2 {{ $errors->has('cart') ? 'is-invalid' : '' }}" name="cart_id" id="cart_id" required>
                    @foreach($carts as $id => $entry)
                        <option value="{{ $id }}" {{ old('cart_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cart'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cart') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.cart_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.cartItem.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quanitty">{{ trans('cruds.cartItem.fields.quanitty') }}</label>
                <input class="form-control {{ $errors->has('quanitty') ? 'is-invalid' : '' }}" type="number" name="quanitty" id="quanitty" value="{{ old('quanitty', '1') }}" step="1" required>
                @if($errors->has('quanitty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quanitty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.quanitty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_price">{{ trans('cruds.cartItem.fields.product_price') }}</label>
                <input class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" type="number" name="product_price" id="product_price" value="{{ old('product_price', '') }}" step="0.01" required>
                @if($errors->has('product_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.product_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color_id">{{ trans('cruds.cartItem.fields.color') }}</label>
                <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id" id="color_id">
                    @foreach($colors as $id => $entry)
                        <option value="{{ $id }}" {{ old('color_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="size_id">{{ trans('cruds.cartItem.fields.size') }}</label>
                <select class="form-control select2 {{ $errors->has('size') ? 'is-invalid' : '' }}" name="size_id" id="size_id">
                    @foreach($sizes as $id => $entry)
                        <option value="{{ $id }}" {{ old('size_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="variation_id">{{ trans('cruds.cartItem.fields.variation') }}</label>
                <select class="form-control select2 {{ $errors->has('variation') ? 'is-invalid' : '' }}" name="variation_id" id="variation_id">
                    @foreach($variations as $id => $entry)
                        <option value="{{ $id }}" {{ old('variation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('variation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cartItem.fields.variation_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection