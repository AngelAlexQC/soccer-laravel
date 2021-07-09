@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.min_age') }}
                        </th>
                        <td>
                            {{ $category->min_age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.max_age') }}
                        </th>
                        <td>
                            {{ $category->max_age }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
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
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#category_clubs" role="tab" data-toggle="tab">
                {{ trans('cruds.club.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#category_championships" role="tab" data-toggle="tab">
                {{ trans('cruds.championship.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="category_clubs">
            @includeIf('admin.categories.relationships.categoryClubs', ['clubs' => $category->categoryClubs])
        </div>
        <div class="tab-pane" role="tabpanel" id="category_championships">
            @includeIf('admin.categories.relationships.categoryChampionships', ['championships' => $category->categoryChampionships])
        </div>
    </div>
</div>

@endsection