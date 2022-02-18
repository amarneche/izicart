@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.menu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.menus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.menu.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.menu.fields.placement') }}</label>
                <select class="form-control {{ $errors->has('placement') ? 'is-invalid' : '' }}" name="placement" id="placement" required>
                    <option value disabled {{ old('placement', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Menu::PLACEMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('placement', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('placement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('placement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.placement_helper') }}</span>
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