<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnrollmentRequest;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Championship;
use App\Models\Club;
use App\Models\Enrollment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollments = Enrollment::with(['championship', 'club', 'players'])->get();

        $championships = Championship::get();

        $clubs = Club::get();

        $users = User::get();

        return view('frontend.enrollments.index', compact('enrollments', 'championships', 'clubs', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('enrollment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championships = Championship::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $players = User::all()->pluck('name', 'id');

        return view('frontend.enrollments.create', compact('championships', 'clubs', 'players'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = Enrollment::create($request->all());
        $enrollment->players()->sync($request->input('players', []));

        return redirect()->route('frontend.enrollments.index');
    }

    public function edit(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championships = Championship::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $players = User::all()->pluck('name', 'id');

        $enrollment->load('championship', 'club', 'players');

        return view('frontend.enrollments.edit', compact('championships', 'clubs', 'players', 'enrollment'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->all());
        $enrollment->players()->sync($request->input('players', []));

        return redirect()->route('frontend.enrollments.index');
    }

    public function show(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->load('championship', 'club', 'players', 'localMatches', 'awayMatches');

        return view('frontend.enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnrollmentRequest $request)
    {
        Enrollment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
