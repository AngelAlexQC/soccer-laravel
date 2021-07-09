@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.championship.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.championships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.id') }}
                        </th>
                        <td>
                            {{ $championship->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.name') }}
                        </th>
                        <td>
                            {{ $championship->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.start_date') }}
                        </th>
                        <td>
                            {{ $championship->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.end_date') }}
                        </th>
                        <td>
                            {{ $championship->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.championship.fields.category') }}
                        </th>
                        <td>
                            {{ $championship->category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.championships.index') }}">
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
    <ul class="nav nav-tabs px-3" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#championship_enrollments" role="tab" data-toggle="tab">
                {{ trans('cruds.enrollment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content p-3">
        <div class="tab-pane" role="tabpanel" id="championship_enrollments">
            @includeIf('admin.championships.relationships.championshipEnrollments', ['enrollments' => $championship->championshipEnrollments])
        </div>
    </div>
</div>

@endsection
