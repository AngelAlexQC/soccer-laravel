@can('championship_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.championships.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.championship.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.championship.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-categoryChampionships">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.championship.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.championship.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.championship.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.championship.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.championship.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($championships as $key => $championship)
                        <tr data-entry-id="{{ $championship->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $championship->id ?? '' }}
                            </td>
                            <td>
                                {{ $championship->name ?? '' }}
                            </td>
                            <td>
                                {{ $championship->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $championship->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $championship->category->name ?? '' }}
                            </td>
                            <td>
                                @can('championship_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.championships.show', $championship->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('championship_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.championships.edit', $championship->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('championship_delete')
                                    <form action="{{ route('admin.championships.destroy', $championship->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('championship_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.championships.massDestroy') }}",
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
  let table = $('.datatable-categoryChampionships:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection