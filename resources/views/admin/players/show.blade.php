@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.player.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.id') }}
                        </th>
                        <td>
                            {{ $player->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.dni') }}
                        </th>
                        <td>
                            {{ $player->dni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.name') }}
                        </th>
                        <td>
                            {{ $player->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.birthdate') }}
                        </th>
                        <td>
                            {{ $player->birthdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $player->approved ? 'checked' : '' }}>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
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
            <a class="nav-link" href="#players_enrollments" role="tab" data-toggle="tab">
                {{ trans('cruds.enrollment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content p-3">
        <div class="tab-pane" role="tabpanel" id="players_enrollments">
            @includeIf('admin.players.relationships.playersEnrollments', ['enrollments' => $player->playersEnrollments])
        </div>
    </div>
</div>

@endsection