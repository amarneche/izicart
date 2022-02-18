@extends('layouts.tenant')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.menu-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.id') }}
                        </th>
                        <td>
                            {{ $menuItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.title') }}
                        </th>
                        <td>
                            {{ $menuItem->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.menu') }}
                        </th>
                        <td>
                            {{ $menuItem->menu->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.link') }}
                        </th>
                        <td>
                            {{ $menuItem->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.page') }}
                        </th>
                        <td>
                            {{ $menuItem->page->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.icon') }}
                        </th>
                        <td>
                            @if($menuItem->icon)
                                <a href="{{ $menuItem->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $menuItem->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuItem.fields.css_class') }}
                        </th>
                        <td>
                            {{ $menuItem->css_class }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('tenant.menu-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection