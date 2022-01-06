@extends('layouts.admin') @section('content')

<div class="card">
    <div class="card-header">
        {{ trans("global.show") }} {{ trans("cruds.championship.title") }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.championships.index') }}">
                    {{ trans("global.back_to_list") }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans("cruds.championship.fields.id") }}
                        </th>
                        <td>
                            {{ $championship->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.championship.fields.name") }}
                        </th>
                        <td>
                            {{ $championship->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.championship.fields.start_date") }}
                        </th>
                        <td>
                            {{ $championship->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.championship.fields.end_date") }}
                        </th>
                        <td>
                            {{ $championship->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.championship.fields.category") }}
                        </th>
                        <td>
                            {{ $championship->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $championship->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.championships.index') }}">
                    {{ trans("global.back_to_list") }}
                </a>
            </div>
        </div>
    </div>
</div>

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
        <a class="btn btn-danger mb-3" href="{{url('admin/championships/'.$championship->id.'/export')}}" role="button">
                <i class="fas fa-file-pdf"></i>Exportar a PDF
            </a>
            <br>
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

@endsection