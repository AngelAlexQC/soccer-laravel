@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.championship.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.championships.update", [$championship->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.championship.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $championship->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.championship.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_date">{{ trans('cruds.championship.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $championship->start_date) }}" required>
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.championship.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.championship.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $championship->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.championship.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.championship.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $championship->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.championship.fields.category_helper') }}</span>
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