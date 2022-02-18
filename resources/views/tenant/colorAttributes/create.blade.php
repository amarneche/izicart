@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.colorAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.color-attributes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.colorAttribute.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colorAttribute.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hex_code">{{ trans('cruds.colorAttribute.fields.hex_code') }}</label>
                <input class="form-control {{ $errors->has('hex_code') ? 'is-invalid' : '' }}" type="text" name="hex_code" id="hex_code" value="{{ old('hex_code', '') }}">
                @if($errors->has('hex_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hex_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.colorAttribute.fields.hex_code_helper') }}</span>
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