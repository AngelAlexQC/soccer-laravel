@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.match.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.matches.update", [$match->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="local_id">{{ trans('cruds.match.fields.local') }}</label>
                <input id="local_id" name="local_id" type="hidden" value="{{ $match->local->id }}">
                <select disabled class="form-control select2 {{ $errors->has('local') ? 'is-invalid' : '' }}" name="local_id" id="local_id" required>
                    @foreach($locals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('local_id') ? old('local_id') : $match->local->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('local'))
                    <div class="invalid-feedback">
                        {{ $errors->first('local') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.match.fields.local_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="away_id">{{ trans('cruds.match.fields.away') }}</label>
                <input id="away_id" name="away_id" type="hidden" value="{{ $match->away->id }}">

                <select disabled class="form-control select2 {{ $errors->has('away') ? 'is-invalid' : '' }}" name="away_id" id="away_id" required>
                    @foreach($aways as $id => $entry)
                        <option value="{{ $id }}" {{ (old('away_id') ? old('away_id') : $match->away->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('away'))
                    <div class="invalid-feedback">
                        {{ $errors->first('away') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.match.fields.away_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.match.fields.start_date') }}</label>
                <input class="form-control datetime {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $match->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.match.fields.start_date_helper') }}</span>
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
