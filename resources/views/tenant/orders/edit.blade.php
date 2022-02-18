@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="order_number">{{ trans('cruds.order.fields.order_number') }}</label>
                <input class="form-control {{ $errors->has('order_number') ? 'is-invalid' : '' }}" type="number" name="order_number" id="order_number" value="{{ old('order_number', $order->order_number) }}" step="1" required>
                @if($errors->has('order_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.order.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $order->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ship_to_wilaya_id">{{ trans('cruds.order.fields.ship_to_wilaya') }}</label>
                <select class="form-control select2 {{ $errors->has('ship_to_wilaya') ? 'is-invalid' : '' }}" name="ship_to_wilaya_id" id="ship_to_wilaya_id" required>
                    @foreach($ship_to_wilayas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ship_to_wilaya_id') ? old('ship_to_wilaya_id') : $order->ship_to_wilaya->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ship_to_wilaya'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ship_to_wilaya') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.ship_to_wilaya_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipt_to_commune_id">{{ trans('cruds.order.fields.shipt_to_commune') }}</label>
                <select class="form-control select2 {{ $errors->has('shipt_to_commune') ? 'is-invalid' : '' }}" name="shipt_to_commune_id" id="shipt_to_commune_id" required>
                    @foreach($shipt_to_communes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shipt_to_commune_id') ? old('shipt_to_commune_id') : $order->shipt_to_commune->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipt_to_commune'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipt_to_commune') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipt_to_commune_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_cost">{{ trans('cruds.order.fields.shipping_cost') }}</label>
                <input class="form-control {{ $errors->has('shipping_cost') ? 'is-invalid' : '' }}" type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $order->shipping_cost) }}" step="0.01" required>
                @if($errors->has('shipping_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_total">{{ trans('cruds.order.fields.sub_total') }}</label>
                <input class="form-control {{ $errors->has('sub_total') ? 'is-invalid' : '' }}" type="number" name="sub_total" id="sub_total" value="{{ old('sub_total', $order->sub_total) }}" step="0.01">
                @if($errors->has('sub_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sub_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.sub_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.order.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="text" name="total" id="total" value="{{ old('total', $order->total) }}">
                @if($errors->has('total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.order.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method_id">{{ trans('cruds.order.fields.payment_method') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method_id" id="payment_method_id">
                    @foreach($payment_methods as $id => $entry)
                        <option value="{{ $id }}" {{ (old('payment_method_id') ? old('payment_method_id') : $order->payment_method->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_method_helper') }}</span>
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