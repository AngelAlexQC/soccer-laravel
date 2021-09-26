@extends('layouts.admin') @section('content') @can('match_create')
<div style="margin-bottom: 10px" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.matches.create') }}">
            {{ trans("global.add") }} {{ trans("cruds.match.title_singular") }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans("cruds.match.title_singular") }} {{ trans("global.list") }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table
                class="
                    table table-bordered table-striped table-hover
                    datatable datatable-Match
                "
            >
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans("cruds.match.fields.id") }}
                        </th>
                        <th>Equipos</th>
                        <th>
                            {{ trans("cruds.match.fields.start_date") }}
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matches as $key => $match)
                    <tr data-entry-id="{{ $match->id }}">
                        <td></td>
                        <td>
                            {{ $match->id ?? '' }}
                        </td>
                        <td>
                            {{ $match->local->name ?? '' }}
                            <br />
                            {{ $match->away->name ?? '' }}
                        </td>
                        <td>
                            {{ $match->start_date ?? '' }}
                        </td>
                        <td>
                            @can('match_show')
                            <a
                                class="btn btn-xs btn-primary"
                                href="{{ route('admin.matches.show', $match->id) }}"
                            >
                                Detalle
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                            @endcan @can('match_edit')
                            <a
                                class="btn btn-xs btn-info"
                                href="{{ route('admin.matches.edit', $match->id) }}"
                            >
                                Cambiar Fecha
                                <i
                                    class="fa fa-calendar"
                                    aria-hidden="true"
                                ></i>
                            </a>
                            @endcan @can('match_delete')
                            <form
                                action="{{ route('admin.matches.destroy', $match->id) }}"
                                method="POST"
                                onsubmit="return confirm(`{{
                                    trans('global.areYouSure')
                                }}`);"
                                style="display: inline-block"
                            >
                                <input
                                    type="hidden"
                                    name="_method"
                                    value="DELETE"
                                />
                                <input
                                    type="hidden"
                                    name="_token"
                                    value="{{ csrf_token() }}"
                                />
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
        let table = $(".datatable-Matche:not(.ajaxTable)").DataTable({
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
