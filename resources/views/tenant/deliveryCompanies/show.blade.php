@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.deliveryCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.delivery-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.id') }}
                        </th>
                        <td>
                            {{ $deliveryCompany->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.company_name') }}
                        </th>
                        <td>
                            {{ $deliveryCompany->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.logo') }}
                        </th>
                        <td>
                            @if($deliveryCompany->logo)
                                <a href="{{ $deliveryCompany->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $deliveryCompany->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.phone') }}
                        </th>
                        <td>
                            {{ $deliveryCompany->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.email') }}
                        </th>
                        <td>
                            {{ $deliveryCompany->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.adresse') }}
                        </th>
                        <td>
                            {{ $deliveryCompany->adresse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.deliveryCompany.fields.ship_to_wilayas') }}
                        </th>
                        <td>
                            @foreach($deliveryCompany->ship_to_wilayas as $key => $ship_to_wilayas)
                                <span class="label label-info">{{ $ship_to_wilayas->wilaya }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.delivery-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection