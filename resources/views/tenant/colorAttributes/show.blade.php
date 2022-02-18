@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.colorAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.color-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $colorAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.value') }}
                        </th>
                        <td>
                            {{ $colorAttribute->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.hex_code') }}
                        </th>
                        <td>
                            {{ $colorAttribute->hex_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.color-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection