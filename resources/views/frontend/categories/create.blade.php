@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.categories.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="min_age">{{ trans('cruds.category.fields.min_age') }}</label>
                            <input class="form-control" type="number" name="min_age" id="min_age" value="{{ old('min_age', '') }}" step="1" required>
                            @if($errors->has('min_age'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('min_age') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.min_age_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="max_age">{{ trans('cruds.category.fields.max_age') }}</label>
                            <input class="form-control" type="number" name="max_age" id="max_age" value="{{ old('max_age', '') }}" step="1">
                            @if($errors->has('max_age'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_age') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.max_age_helper') }}</span>
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