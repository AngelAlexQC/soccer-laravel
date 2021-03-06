@extends('layouts.admin') @section('content') @can('enrollment_create')
<div style="margin-bottom: 10px" class="row">
    <div class="col-lg-12">
        <a
            class="btn btn-success"
            href="{{ route('admin.enrollments.create') }}"
        >
            {{ trans("global.add") }}
            {{ trans("cruds.enrollment.title_singular") }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans("cruds.enrollment.title_singular") }}
        {{ trans("global.list") }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table
                class="
                    table table-bordered table-striped table-hover
                    datatable datatable-Enrollment
                "
            >
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans("cruds.enrollment.fields.id") }}
                        </th>
                        <th>
                            {{ trans("cruds.enrollment.fields.championship") }}
                        </th>
                        <th>
                            {{ trans("cruds.enrollment.fields.club") }}
                        </th>
                        <th>Puntos</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input
                                class="search"
                                type="text"
                                placeholder="{{ trans('global.search') }}"
                            />
                        </td>
                        <td>
                            <input
                                class="search"
                                type="text"
                                placeholder="{{ trans('global.search') }}"
                            />
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans("global.all") }}</option>
                                @foreach($championships as $key => $item)
                                <option value="{{ $item->name }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans("global.all") }}</option>
                                @foreach($clubs as $key => $item)
                                <option value="{{ $item->name }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans("global.all") }}</option>
                                @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $key => $enrollment)
                    <tr data-entry-id="{{ $enrollment->id }}">
                        <td></td>
                        <td>
                            {{ $enrollment->id ?? '' }}
                        </td>
                        <td>
                            {{ $enrollment->championship->name ?? '' }}
                        </td>
                        <td>
                            {{ $enrollment->club->name ?? '' }}
                        </td>
                        <td>
                            {{ $enrollment->points }}
                        </td>
                        <td>
                            @can('enrollment_edit')
                            <a
                                class="btn btn-xs btn-info"
                                href="{{ route('admin.enrollments.edit', $enrollment->id) }}"
                            >
                                Detalle
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
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
        let table = $(".datatable-Enrollment:not(.ajaxTable)").DataTable({
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
