@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.wilaya.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.wilayas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="wilaya">{{ trans('cruds.wilaya.fields.wilaya') }}</label>
                <input class="form-control {{ $errors->has('wilaya') ? 'is-invalid' : '' }}" type="text" name="wilaya" id="wilaya" value="{{ old('wilaya', '') }}" required>
                @if($errors->has('wilaya'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wilaya') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilaya.fields.wilaya_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wilaya_ar">{{ trans('cruds.wilaya.fields.wilaya_ar') }}</label>
                <input class="form-control {{ $errors->has('wilaya_ar') ? 'is-invalid' : '' }}" type="text" name="wilaya_ar" id="wilaya_ar" value="{{ old('wilaya_ar', '') }}">
                @if($errors->has('wilaya_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wilaya_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilaya.fields.wilaya_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_available') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" required {{ old('is_available', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_available">{{ trans('cruds.wilaya.fields.is_available') }}</label>
                </div>
                @if($errors->has('is_available'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_available') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilaya.fields.is_available_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_cost">{{ trans('cruds.wilaya.fields.default_cost') }}</label>
                <input class="form-control {{ $errors->has('default_cost') ? 'is-invalid' : '' }}" type="text" name="default_cost" id="default_cost" value="{{ old('default_cost', '0') }}">
                @if($errors->has('default_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilaya.fields.default_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_methods">{{ trans('cruds.wilaya.fields.payment_methods') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('payment_methods') ? 'is-invalid' : '' }}" name="payment_methods[]" id="payment_methods" multiple>
                    @foreach($payment_methods as $id => $payment_method)
                        <option value="{{ $id }}" {{ in_array($id, old('payment_methods', [])) ? 'selected' : '' }}>{{ $payment_method }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_methods'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_methods') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilaya.fields.payment_methods_helper') }}</span>
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