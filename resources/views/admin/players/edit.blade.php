@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.player.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.players.update", [$player->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="dni">{{ trans('cruds.player.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni"
                    id="dni" value="{{ old('dni', $player->dni) }}" required>
                @if($errors->has('dni'))
                <div class="invalid-feedback">
                    {{ $errors->first('dni') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.dni_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.player.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $player->name) }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birthdate">{{ trans('cruds.player.fields.birthdate') }}</label>
                <input class="form-control date {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="text"
                    name="birthdate" id="birthdate" value="{{ old('birthdate', $player->birthdate) }}" required>
                @if($errors->has('birthdate'))
                <div class="invalid-feedback">
                    {{ $errors->first('birthdate') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.birthdate_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1"
                        {{ $player->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.player.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                <div class="invalid-feedback">
                    {{ $errors->first('approved') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.approved_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection