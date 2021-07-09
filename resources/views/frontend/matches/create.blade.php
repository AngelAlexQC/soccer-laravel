@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.match.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.matches.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="local_id">{{ trans('cruds.match.fields.local') }}</label>
                            <select class="form-control select2" name="local_id" id="local_id" required>
                                @foreach($locals as $id => $entry)
                                    <option value="{{ $id }}" {{ old('local_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="away_id" id="away_id" required>
                                @foreach($aways as $id => $entry)
                                    <option value="{{ $id }}" {{ old('away_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control datetime" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
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

        </div>
    </div>
</div>
@endsection