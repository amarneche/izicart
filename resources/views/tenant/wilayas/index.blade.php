@extends('layouts.tenant')
@section('content')
@can('wilaya_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.wilayas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.wilaya.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.wilaya.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Wilaya">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.wilaya.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.wilaya.fields.wilaya') }}
                        </th>
                        <th>
                            {{ trans('cruds.wilaya.fields.is_available') }}
                        </th>
                        <th>
                            {{ trans('cruds.wilaya.fields.default_cost') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wilayas as $key => $wilaya)
                        <tr data-entry-id="{{ $wilaya->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $wilaya->id ?? '' }}
                            </td>
                            <td>
                                {{ $wilaya->wilaya ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $wilaya->is_available ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $wilaya->is_available ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $wilaya->default_cost ?? '' }}
                            </td>
                            <td>
                                @can('wilaya_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.wilayas.show', $wilaya->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('wilaya_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.wilayas.edit', $wilaya->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('wilaya_delete')
                                    <form action="{{ route('tenant.wilayas.destroy', $wilaya->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('wilaya_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.wilayas.massDestroy') }}",
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
  let table = $('.datatable-Wilaya:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection