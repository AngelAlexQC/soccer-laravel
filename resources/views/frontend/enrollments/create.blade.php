@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.enrollment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.enrollments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.enrollment.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enrollment.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="championship_id">{{ trans('cruds.enrollment.fields.championship') }}</label>
                            <select class="form-control select2" name="championship_id" id="championship_id" required>
                                @foreach($championships as $id => $entry)
                                    <option value="{{ $id }}" {{ old('championship_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('championship'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('championship') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enrollment.fields.championship_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="club_id">{{ trans('cruds.enrollment.fields.club') }}</label>
                            <select class="form-control select2" name="club_id" id="club_id" required>
                                @foreach($clubs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('club_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('club'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('club') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enrollment.fields.club_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="players">{{ trans('cruds.enrollment.fields.players') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="players[]" id="players" multiple required>
                                @foreach($players as $id => $players)
                                    <option value="{{ $id }}" {{ in_array($id, old('players', [])) ? 'selected' : '' }}>{{ $players }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('players'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('players') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.enrollment.fields.players_helper') }}</span>
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