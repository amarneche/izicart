@extends('layouts.tenant')
@section('content')
@can('variation_attribute_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tenant.variation-attributes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.variationAttribute.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.variationAttribute.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-VariationAttribute">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.value') }}
                        </th>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.variationAttribute.fields.gallery') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($variationAttributes as $key => $variationAttribute)
                        <tr data-entry-id="{{ $variationAttribute->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $variationAttribute->id ?? '' }}
                            </td>
                            <td>
                                {{ $variationAttribute->value ?? '' }}
                            </td>
                            <td>
                                @if($variationAttribute->image)
                                    <a href="{{ $variationAttribute->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $variationAttribute->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($variationAttribute->gallery as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('variation_attribute_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('tenant.variation-attributes.show', $variationAttribute->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('variation_attribute_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('tenant.variation-attributes.edit', $variationAttribute->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('variation_attribute_delete')
                                    <form action="{{ route('tenant.variation-attributes.destroy', $variationAttribute->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('variation_attribute_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('tenant.variation-attributes.massDestroy') }}",
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
  let table = $('.datatable-VariationAttribute:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection