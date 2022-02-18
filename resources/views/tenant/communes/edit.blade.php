@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.commune.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.communes.update", [$commune->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="commune">{{ trans('cruds.commune.fields.commune') }}</label>
                <input class="form-control {{ $errors->has('commune') ? 'is-invalid' : '' }}" type="text" name="commune" id="commune" value="{{ old('commune', $commune->commune) }}" required>
                @if($errors->has('commune'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commune') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commune.fields.commune_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commune_ar">{{ trans('cruds.commune.fields.commune_ar') }}</label>
                <input class="form-control {{ $errors->has('commune_ar') ? 'is-invalid' : '' }}" type="text" name="commune_ar" id="commune_ar" value="{{ old('commune_ar', $commune->commune_ar) }}">
                @if($errors->has('commune_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commune_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commune.fields.commune_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="wilayas">{{ trans('cruds.commune.fields.wilaya') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('wilayas') ? 'is-invalid' : '' }}" name="wilayas[]" id="wilayas" multiple required>
                    @foreach($wilayas as $id => $wilaya)
                        <option value="{{ $id }}" {{ (in_array($id, old('wilayas', [])) || $commune->wilayas->contains($id)) ? 'selected' : '' }}>{{ $wilaya }}</option>
                    @endforeach
                </select>
                @if($errors->has('wilayas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wilayas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commune.fields.wilaya_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_available') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ $commune->is_available || old('is_available', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="is_available">{{ trans('cruds.commune.fields.is_available') }}</label>
                </div>
                @if($errors->has('is_available'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_available') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commune.fields.is_available_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_cost">{{ trans('cruds.commune.fields.delivery_cost') }}</label>
                <input class="form-control {{ $errors->has('delivery_cost') ? 'is-invalid' : '' }}" type="number" name="delivery_cost" id="delivery_cost" value="{{ old('delivery_cost', $commune->delivery_cost) }}" step="0.01">
                @if($errors->has('delivery_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.commune.fields.delivery_cost_helper') }}</span>
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