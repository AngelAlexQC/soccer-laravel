@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.club.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.id') }}
                        </th>
                        <td>
                            {{ $club->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.name') }}
                        </th>
                        <td>
                            {{ $club->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.slug') }}
                        </th>
                        <td>
                            {{ $club->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.category') }}
                        </th>
                        <td>
                            {{ $club->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.picture') }}
                        </th>
                        <td>
                            @if($club->picture)
                                <a href="{{ $club->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $club->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
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
            <a class="nav-link" href="#club_enrollments" role="tab" data-toggle="tab">
                {{ trans('cruds.enrollment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="club_enrollments">
            @includeIf('admin.clubs.relationships.clubEnrollments', ['enrollments' => $club->clubEnrollments])
        </div>
    </div>
</div>

@endsection