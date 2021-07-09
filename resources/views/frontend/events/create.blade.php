@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.events.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.event.fields.type') }}</label>
                            @foreach(App\Models\Event::TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="type_{{ $key }}">{{ $label }}</label>
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
                            <input class="form-control" type="number" name="minute" id="minute" value="{{ old('minute', '') }}" step="1">
                            @if($errors->has('minute'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('minute') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.minute_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="match_id">{{ trans('cruds.event.fields.match') }}</label>
                            <select class="form-control select2" name="match_id" id="match_id" required>
                                @foreach($matches as $id => $entry)
                                    <option value="{{ $id }}" {{ old('match_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('match'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('match') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.match_helper') }}</span>
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