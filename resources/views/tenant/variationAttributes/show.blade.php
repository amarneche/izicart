@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.variationAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.variation-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $variationAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.value') }}
                        </th>
                        <td>
                            {{ $variationAttribute->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.image') }}
                        </th>
                        <td>
                            @if($variationAttribute->image)
                                <a href="{{ $variationAttribute->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $variationAttribute->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($variationAttribute->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.variation-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection