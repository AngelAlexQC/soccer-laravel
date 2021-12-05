@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }} {{$championship->name}}
    </div>

    <div class="card-body">

        <!-- Buttons for each championship -->
        <div class="container-fluid-border">
            @foreach($championships as $championship)
            <a class="btn btn-primary" href="{{route('admin.systemCalendar.show', $championship->id)}}">
                {{$championship->name}}
            </a>
            @endforeach
        </div>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        <div id='calendar'></div>
    </div>
</div>

<!-- If championship is set, show the championship -->
@if(isset($championship))
<div class="card">
    <div class="card-header">
        {{ trans("global.relatedData") }}
    </div>
    <ul class="nav nav-tabs px-3" role="tablist" id="relationship-tabs">
        <li class="nav-item active">
            <a class="nav-link active" href="#championship_matches" role="tab" data-toggle="tab">
                {{ trans("cruds.match.title") }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#championship_enrollments" role="tab" data-toggle="tab">
                Tabla de Posiciones
            </a>
        </li>
    </ul>
    <div class="tab-content p-3">
        <div class="tab-pane w-100 active" role="tabpanel" id="championship_matches">
            <table class="table table-striped table-hover table-inverse datatable">
                <div class="w-100">
                    <div class="row mb-3">
                        <div class="col">
                            <a type="button" class="btn btn-primary" href="{{
                                    route(
                                        'admin.championships.generate',
                                        ['championship'=>$championship->id]
                                    )
                                }}">
                                Generar Partidos
                            </a>
                        </div>
                    </div>
                </div>
                <thead class="thead-inverse">
                    <tr>
                        <th>ID.</th>
                        <th>Fechaº</th>
                        <th>Local</th>
                        <th>Visitante</th>
                        <th>Fecha - Hora</th>
                        <th>Ganador</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($championship->championshipMatches as $matche)
                    <tr>
                        <td scope="row">
                            {{ $matche->id }}
                        </td>
                        <td>
                            {{ $matche->round }}
                        </td>
                        <td>
                            {{ $matche->local->club->name }}
                        </td>
                        <td>
                            {{ $matche->away->club->name }}
                        </td>
                        <td>
                            {{ $matche->start_date }}
                        </td>
                        <td>
                            @if($matche->start_date) @if($matche->winner)
                            {{ $matche->winner->name }}
                            @else Empate @endif @else No Jugado @endif
                        </td>
                        <td>
                            @can('match_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.matches.show', $matche->id) }}">
                                Detalle
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                            @endcan @can('match_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.matches.edit', $matche->id) }}">
                                Cambiar Fecha
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" role="tabpanel" id="championship_enrollments">
            <table class="
                    table
                    table-striped
                    table-hover
                    table-inverse
                    table-responsive
                ">
                <thead class="thead-inverse">
                    <tr class="text-center">
                        <th>Equipo</th>
                        <th>PJ</th>
                        <th>PG</th>
                        <th>PE</th>
                        <th>PP</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>PTS</th>
                        <th>GD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderedChampionshipEnrollments as $enrollment)
                    <tr>
                        <td scope="row">
                            {{ $enrollment->club->name }}
                        </td>
                        <td>
                            {{ $enrollment->matches_played() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_won() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_draw() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_lost() }}
                        </td>
                        <td>
                            {{ $enrollment->goals_for() }}
                        </td>
                        <td>
                            {{ $enrollment->goals_against() }}
                        </td>
                        <td scope="row">
                            {{ $enrollment->points }}
                        </td>
                        <td class="text-end">
                            {{
                                $enrollment->goals_difference()
                            }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
        // page is now ready, initialize the calendar...
        events = {!! json_encode($events); !!};
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        events: events,


    })
        });
</script>
@stop