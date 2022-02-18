@can('menu_item_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.menu-items.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.menuItem.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.menuItem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-menuMenuItems">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.menuItem.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuItem.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuItem.fields.menu') }}
                        </th>
                        <th>
                            {{ trans('cruds.menu.fields.placement') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuItem.fields.page') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuItem.fields.icon') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuItems as $key => $menuItem)
                        <tr data-entry-id="{{ $menuItem->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menuItem->id ?? '' }}
                            </td>
                            <td>
                                {{ $menuItem->title ?? '' }}
                            </td>
                            <td>
                                {{ $menuItem->menu->title ?? '' }}
                            </td>
                            <td>
                                @if($menuItem->menu)
                                    {{ $menuItem->menu::PLACEMENT_SELECT[$menuItem->menu->placement] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $menuItem->page->title ?? '' }}
                            </td>
                            <td>
                                @if($menuItem->icon)
                                    <a href="{{ $menuItem->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $menuItem->icon->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('menu_item_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.menu-items.show', $menuItem->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('menu_item_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.menu-items.edit', $menuItem->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('menu_item_delete')
                                    <form action="{{ route('tenant.menu-items.destroy', $menuItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('menu_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.menu-items.massDestroy') }}",
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
  let table = $('.datatable-menuMenuItems:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection