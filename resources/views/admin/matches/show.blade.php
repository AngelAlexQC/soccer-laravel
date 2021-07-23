@extends('layouts.admin') @section('content')

<div class="card">
    <div class="card-header">
        {{ trans("global.show") }} {{ trans("cruds.match.title") }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.matches.index') }}">
                    {{ trans("global.back_to_list") }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans("cruds.match.fields.id") }}
                        </th>
                        <td>
                            {{ $match->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.match.fields.name") }}
                        </th>
                        <td>
                            {{ $match->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.match.fields.local") }}
                        </th>
                        <td>
                            {{ $match->local->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.match.fields.away") }}
                        </th>
                        <td>
                            {{ $match->away->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans("cruds.match.fields.start_date") }}
                        </th>
                        <td>
                            {{ $match->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Resultado
                        </th>
                        <td>
                            {{ count($match->goals_local) ." - ". count($match->goals_away) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Ganador
                        </th>
                        <td>
                            @if($match->winner)
                            {{ $match->winner }}
                            @else
                            Empate
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.matches.index') }}">
                    {{ trans("global.back_to_list") }}
                </a>
            </div>
            <ul class="nav nav-tabs px-3" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#match_events" role="tab" data-toggle="tab">
                        {{ trans("cruds.event.title") }}
                    </a>
                </li>
            </ul>
            <div class="tab-content p-3 ">
                <div class="tab-pane w-100 active" role="tabpanel" id="match_events">
                    <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
                        @csrf

                        <input id="match_id" name="match_id" type="hidden" value="{{ $match->id }}">
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.event.fields.type') }}</label>
                            @foreach(App\Models\Event::TYPE_RADIO as $key => $label)
                            <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type"
                                    value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }}
                                    required>
                                <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                            </div>
                            @endforeach
                            @if($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="minute">{{ trans('cruds.event.fields.minute') }}</label>
                            <input class="form-control {{ $errors->has('minute') ? 'is-invalid' : '' }}" type="number"
                                name="minute" id="minute" value="{{ old('minute', '') }}" step="1">
                            @if($errors->has('minute'))
                            <div class="invalid-feedback">
                                {{ $errors->first('minute') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.minute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="club_id">Equipo</label>
                            <select class="form-control" name="club_id" id="club_id">
                                <option value="{{ null }}" disabled selected>
                                    -Seleccione un Equipo-
                                </option>
                                <option value="{{ $match->local->id }}">
                                    {{ $match->local->name }}
                                </option>
                                <option value="{{ $match->away->id }}">
                                    {{ $match->away->name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                            <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">
                                Añadir <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                    @includeIf('admin.matches.relationships.matchEvents',
                    ['events' => $match->matchEvents])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
