@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.wilaya.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.wilayas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.id') }}
                        </th>
                        <td>
                            {{ $wilaya->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.wilaya') }}
                        </th>
                        <td>
                            {{ $wilaya->wilaya }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.wilaya_ar') }}
                        </th>
                        <td>
                            {{ $wilaya->wilaya_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.is_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $wilaya->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.default_cost') }}
                        </th>
                        <td>
                            {{ $wilaya->default_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilaya.fields.payment_methods') }}
                        </th>
                        <td>
                            @foreach($wilaya->payment_methods as $key => $payment_methods)
                                <span class="label label-info">{{ $payment_methods->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.wilayas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#wilaya_communes" role="tab" data-toggle="tab">
                {{ trans('cruds.commune.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#wilaya_payment_methods" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentMethod.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ship_to_wilayas_delivery_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.deliveryCompany.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="wilaya_communes">
            @includeIf('admin.wilayas.relationships.wilayaCommunes', ['communes' => $wilaya->wilayaCommunes])
        </div>
        <div class="tab-pane" role="tabpanel" id="wilaya_payment_methods">
            @includeIf('admin.wilayas.relationships.wilayaPaymentMethods', ['paymentMethods' => $wilaya->wilayaPaymentMethods])
        </div>
        <div class="tab-pane" role="tabpanel" id="ship_to_wilayas_delivery_companies">
            @includeIf('admin.wilayas.relationships.shipToWilayasDeliveryCompanies', ['deliveryCompanies' => $wilaya->shipToWilayasDeliveryCompanies])
        </div>
    </div>
</div>

@endsection