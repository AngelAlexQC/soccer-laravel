@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enrollment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enrollments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.id') }}
                        </th>
                        <td>
                            {{ $enrollment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.name') }}
                        </th>
                        <td>
                            {{ $enrollment->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.championship') }}
                        </th>
                        <td>
                            {{ $enrollment->championship->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.club') }}
                        </th>
                        <td>
                            {{ $enrollment->club->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.players') }}
                        </th>
                        <td>
                            @foreach($enrollment->players as $key => $players)
                                <span class="label label-info">{{ $players->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.enrollments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs px-3" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#local_matches" role="tab" data-toggle="tab">
                {{ trans('cruds.match.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#away_matches" role="tab" data-toggle="tab">
                {{ trans('cruds.match.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content p-3">
        <div class="tab-pane" role="tabpanel" id="local_matches">
            @includeIf('admin.enrollments.relationships.localMatches', ['matches' => $enrollment->localMatches])
        </div>
        <div class="tab-pane" role="tabpanel" id="away_matches">
            @includeIf('admin.enrollments.relationships.awayMatches', ['matches' => $enrollment->awayMatches])
        </div>
    </div>
</div>

@endsection
