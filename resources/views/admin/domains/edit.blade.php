@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.domain.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.domains.update", [$domain->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="domain">{{ trans('cruds.domain.fields.domain') }}</label>
                <input class="form-control {{ $errors->has('domain') ? 'is-invalid' : '' }}" type="text" name="domain" id="domain" value="{{ old('domain', $domain->domain) }}" required>
                @if($errors->has('domain'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domain') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.domain.fields.domain_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tenant_id">{{ trans('cruds.domain.fields.tenant') }}</label>
                <select class="form-control select2 {{ $errors->has('tenant') ? 'is-invalid' : '' }}" name="tenant_id" id="tenant_id" required>
                    @foreach($tenants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tenant_id') ? old('tenant_id') : $domain->tenant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.domain.fields.tenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.domain.fields.domain_type') }}</label>
                <select class="form-control {{ $errors->has('domain_type') ? 'is-invalid' : '' }}" name="domain_type" id="domain_type" required>
                    <option value disabled {{ old('domain_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Domain::DOMAIN_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('domain_type', $domain->domain_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('domain_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domain_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.domain.fields.domain_type_helper') }}</span>
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