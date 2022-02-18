@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.menuItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tenant.menu-items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.menuItem.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_id">{{ trans('cruds.menuItem.fields.menu') }}</label>
                <select class="form-control select2 {{ $errors->has('menu') ? 'is-invalid' : '' }}" name="menu_id" id="menu_id" required>
                    @foreach($menus as $id => $entry)
                        <option value="{{ $id }}" {{ old('menu_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.menu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.menuItem.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_id">{{ trans('cruds.menuItem.fields.page') }}</label>
                <select class="form-control select2 {{ $errors->has('page') ? 'is-invalid' : '' }}" name="page_id" id="page_id">
                    @foreach($pages as $id => $entry)
                        <option value="{{ $id }}" {{ old('page_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('page'))
                    <div class="invalid-feedback">
                        {{ $errors->first('page') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.page_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.menuItem.fields.icon') }}</label>
                <div class="needsclick dropzone {{ $errors->has('icon') ? 'is-invalid' : '' }}" id="icon-dropzone">
                </div>
                @if($errors->has('icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.icon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="css_class">{{ trans('cruds.menuItem.fields.css_class') }}</label>
                <input class="form-control {{ $errors->has('css_class') ? 'is-invalid' : '' }}" type="text" name="css_class" id="css_class" value="{{ old('css_class', '') }}">
                @if($errors->has('css_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('css_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menuItem.fields.css_class_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.iconDropzone = {
    url: '{{ route('tenant.menu-items.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="icon"]').remove()
      $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="icon"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($menuItem) && $menuItem->icon)
      var file = {!! json_encode($menuItem->icon) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection