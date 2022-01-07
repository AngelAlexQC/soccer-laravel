@extends('layouts.admin') @section('content')
<h3 class="page-title">{{ trans("global.systemCalendar") }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans("global.systemCalendar") }}
    </div>

    <div class="card-body">
        <!-- Buttons for each championship -->
        <div class="container-fluid-border">
            @foreach($championships as $championship)
            <a
                class="btn btn-primary"
                href="{{route('admin.systemCalendar.show', $championship->id)}}"
            >
                {{$championship->name}}
            </a>
            @endforeach
        </div>

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css"
        />
        <div id="calendar"></div>
    </div>
</div>

@endsection @section('scripts') @parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.js"></script>
<script>
    $(document).ready(function () {
        // page is now ready, initialize the calendar...
        events = {!! json_encode($events); !!};
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        events: events,
        locale: '{{App::getLocale()}}',

    })
        });
</script>
@stop
