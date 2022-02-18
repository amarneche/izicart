@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.payment-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.title') }}
                        </th>
                        <td>
                            {{ $paymentMethod->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.description') }}
                        </th>
                        <td>
                            {{ $paymentMethod->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.photo') }}
                        </th>
                        <td>
                            @if($paymentMethod->photo)
                                <a href="{{ $paymentMethod->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $paymentMethod->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.wilaya') }}
                        </th>
                        <td>
                            @foreach($paymentMethod->wilayas as $key => $wilaya)
                                <span class="label label-info">{{ $wilaya->wilaya }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMethod.fields.instruction') }}
                        </th>
                        <td>
                            {!! $paymentMethod->instruction !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.payment-methods.index') }}">
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
            <a class="nav-link" href="#payment_methods_wilayas" role="tab" data-toggle="tab">
                {{ trans('cruds.wilaya.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="payment_methods_wilayas">
            @includeIf('admin.paymentMethods.relationships.paymentMethodsWilayas', ['wilayas' => $paymentMethod->paymentMethodsWilayas])
        </div>
    </div>
</div>

@endsection