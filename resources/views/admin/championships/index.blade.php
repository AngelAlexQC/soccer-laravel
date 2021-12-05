@extends('layouts.admin') @section('content') @can('championship_create')
<div style="margin-bottom: 10px" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.championships.create') }}">
            {{ trans("global.add") }}
            {{ trans("cruds.championship.title_singular") }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans("cruds.championship.title_singular") }}
        {{ trans("global.list") }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="
                    table table-bordered table-striped table-hover
                    datatable datatable-Championship
                ">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans("cruds.championship.fields.id") }}
                        </th>
                        <th>
                            {{ trans("cruds.championship.fields.name") }}
                        </th>
                        <th>
                            {{ trans("cruds.championship.fields.start_date") }}
                        </th>
                        <th>
                            {{ trans("cruds.championship.fields.end_date") }}
                        </th>
                        <th>
                            {{ trans("cruds.championship.fields.category") }}
                        </th>
                        <th>
                            {{ trans("cruds.championship.fields.active") }}
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" />
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" />
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <select class="search">
                                <option value>{{ trans("global.all") }}</option>
                                @foreach($categories as $key => $item)
                                <option value="{{ $item->name }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($championships as $key => $championship)
                    <tr data-entry-id="{{ $championship->id }}">
                        <td></td>
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
                            <span style="display:none">{{ $championship->active ?? '' }}</span>
                            <input type="checkbox" disabled="disabled" {{ $championship->active ? 'checked' : '' }}>
                        </td>
                        <td>
                            @can('championship_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.championships.show', $championship->id) }}">
                                Detalle
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                            @endcan
                            @can('championship_edit')
                            <br>
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.championships.edit', $championship->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('championship_delete')
                            <form action="{{ route('admin.championships.destroy', $championship->id) }}" method="POST"
                                onsubmit="return confirm(`{{ trans('global.areYouSure') }}`);"
                                style="display: inline-block;">
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

@endsection @section('scripts') @parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, "desc"]],
            pageLength: 100,
        });
        let table = $(".datatable-Championship:not(.ajaxTable)").DataTable({
            buttons: dtButtons,
        });
        $('a[data-toggle="tab"]').on("shown.bs.tab click", function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        let visibleColumnsIndexes = null;
        $(".datatable thead").on("input", ".search", function () {
            let strict = $(this).attr("strict") || false;
            let value =
                strict && this.value ? "^" + this.value + "$" : this.value;

            let index = $(this).parent().index();
            if (visibleColumnsIndexes !== null) {
                index = visibleColumnsIndexes[index];
            }

            table.column(index).search(value, strict).draw();
        });
        table.on("column-visibility.dt", function (e, settings, column, state) {
            visibleColumnsIndexes = [];
            table.columns(":visible").every(function (colIdx) {
                visibleColumnsIndexes.push(colIdx);
            });
        });
    });
</script>
@endsection