@extends('layouts.admin')
@section('content')
@can('player_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.players.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.player.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.player.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.player.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.dni') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.birthdate') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.approved') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>

                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $key => $player)
                    <tr data-entry-id="{{ $player->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $player->id ?? '' }}
                        </td>
                        <td>
                            {{ $player->dni ?? '' }}
                        </td>
                        <td>
                            {{ $player->name ?? '' }}
                        </td>
                        <td>
                            {{ $player->birthdate ?? '' }}
                        </td>
                        <td>
                            <span style="display:none">{{ $player->approved ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $player->approved ? 'checked' : '' }}>
                        </td>
                        <td>
                            @can('player_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.players.show', $player->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('player_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.players.edit', $player->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('player_delete')
                            <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm(`{{ trans('global.areYouSure') }}`);" style="display: inline-block;">
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


        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 100,
        });
        let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        let visibleColumnsIndexes = null;
        $('.datatable thead').on('input', '.search', function () {
            let strict = $(this).attr('strict') || false
            let value = strict && this.value ? "^" + this.value + "$" : this.value

            let index = $(this).parent().index()
            if (visibleColumnsIndexes !== null) {
                index = visibleColumnsIndexes[index]
            }

            table
                .column(index)
                .search(value, strict)
                .draw()
        });
        table.on('column-visibility.dt', function (e, settings, column, state) {
            visibleColumnsIndexes = []
            table.columns(":visible").every(function (colIdx) {
                visibleColumnsIndexes.push(colIdx);
            });
        })
    })

</script>
@endsection