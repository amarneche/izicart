@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.commune.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.communes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.id') }}
                        </th>
                        <td>
                            {{ $commune->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.commune') }}
                        </th>
                        <td>
                            {{ $commune->commune }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.commune_ar') }}
                        </th>
                        <td>
                            {{ $commune->commune_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.wilaya') }}
                        </th>
                        <td>
                            @foreach($commune->wilayas as $key => $wilaya)
                                <span class="label label-info">{{ $wilaya->wilaya }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.is_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $commune->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commune.fields.delivery_cost') }}
                        </th>
                        <td>
                            {{ $commune->delivery_cost }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.communes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection