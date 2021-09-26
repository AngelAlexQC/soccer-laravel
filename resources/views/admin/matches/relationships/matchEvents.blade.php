<div class="card">
    <div class="card-header">
        {{ trans("global.list") }} {{ trans("cruds.event.title_singular") }}s
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table
                class="
                    table table-bordered table-striped table-hover
                    datatable datatable-matchEvents
                "
            >
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans("cruds.event.fields.id") }}
                        </th>
                        <th>
                            {{ trans("cruds.event.fields.type") }}
                        </th>
                        <th>
                            {{ trans("cruds.event.fields.minute") }}
                        </th>
                        <th>
                            {{ trans("cruds.event.fields.description") }}
                        </th>
                        <th>
                            {{ trans("cruds.event.fields.match") }}
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                    <tr data-entry-id="{{ $event->id }}">
                        <td></td>
                        <td>
                            {{ $event->id ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Event::TYPE_RADIO[$event->type] ?? '' }}
                        </td>
                        <td>
                            {{ $event->minute ?? '' }}
                        </td>
                        <td>
                            {{ $event->description ?? '' }}
                        </td>
                        <td>
                            {{ $event->match->name ?? '' }}
                        </td>
                        <td>
                            @can('event_show')
                            <a
                                class="btn btn-xs btn-primary"
                                href="{{ route('admin.events.show', $event->id) }}"
                            >
                                {{ trans("global.view") }}
                            </a>
                            @endcan @can('event_edit')
                            <a
                                class="btn btn-xs btn-info"
                                href="{{ route('admin.events.edit', $event->id) }}"
                            >
                                {{ trans("global.edit") }}
                            </a>
                            @endcan @can('event_delete')
                            <form
                                action="{{ route('admin.events.destroy', $event->id) }}"
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

@section('scripts') @parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, "desc"]],
            pageLength: 100,
        });
        let table = $(".datatable-matchEvents:not(.ajaxTable)").DataTable({
            buttons: dtButtons,
        });
        $('a[data-toggle="tab"]').on("shown.bs.tab click", function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
