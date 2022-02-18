@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cart.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.carts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cart_number">{{ trans('cruds.cart.fields.cart_number') }}</label>
                <input class="form-control {{ $errors->has('cart_number') ? 'is-invalid' : '' }}" type="text" name="cart_number" id="cart_number" value="{{ old('cart_number', '') }}" required>
                @if($errors->has('cart_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cart_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.cart_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cart_total">{{ trans('cruds.cart.fields.cart_total') }}</label>
                <input class="form-control {{ $errors->has('cart_total') ? 'is-invalid' : '' }}" type="number" name="cart_total" id="cart_total" value="{{ old('cart_total', '') }}" step="0.01">
                @if($errors->has('cart_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cart_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.cart_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.cart.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cart::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'abandoned') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.cart.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cart.fields.customer_helper') }}</span>
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