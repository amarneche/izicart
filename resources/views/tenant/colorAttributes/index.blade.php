@extends('layouts.tenant')
@section('content')
@can('color_attribute_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.color-attributes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.colorAttribute.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.colorAttribute.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ColorAttribute">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.value') }}
                        </th>
                        <th>
                            {{ trans('cruds.colorAttribute.fields.hex_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colorAttributes as $key => $colorAttribute)
                        <tr data-entry-id="{{ $colorAttribute->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $colorAttribute->id ?? '' }}
                            </td>
                            <td>
                                {{ $colorAttribute->value ?? '' }}
                            </td>
                            <td>
                                {{ $colorAttribute->hex_code ?? '' }}
                            </td>
                            <td>
                                @can('color_attribute_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.color-attributes.show', $colorAttribute->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('color_attribute_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.color-attributes.edit', $colorAttribute->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('color_attribute_delete')
                                    <form action="{{ route('tenant.color-attributes.destroy', $colorAttribute->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('color_attribute_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.color-attributes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ColorAttribute:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection