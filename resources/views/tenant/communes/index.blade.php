@extends('layouts.tenant')
@section('content')
@can('commune_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.communes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.commune.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.commune.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Commune">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.commune.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.commune.fields.commune') }}
                        </th>
                        <th>
                            {{ trans('cruds.commune.fields.wilaya') }}
                        </th>
                        <th>
                            {{ trans('cruds.commune.fields.is_available') }}
                        </th>
                        <th>
                            {{ trans('cruds.commune.fields.delivery_cost') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($communes as $key => $commune)
                        <tr data-entry-id="{{ $commune->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $commune->id ?? '' }}
                            </td>
                            <td>
                                {{ $commune->commune ?? '' }}
                            </td>
                            <td>
                                @foreach($commune->wilayas as $key => $item)
                                    <span class="badge badge-info">{{ $item->wilaya }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span style="display:none">{{ $commune->is_available ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $commune->is_available ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $commune->delivery_cost ?? '' }}
                            </td>
                            <td>
                                @can('commune_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.communes.show', $commune->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('commune_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.communes.edit', $commune->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('commune_delete')
                                    <form action="{{ route('tenant.communes.destroy', $commune->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('commune_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.communes.massDestroy') }}",
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
  let table = $('.datatable-Commune:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection