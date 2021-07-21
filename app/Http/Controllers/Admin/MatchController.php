<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatchRequest;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Models\Enrollment;
use App\Models\Matche;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatchController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('match_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matches = Matche::with(['local', 'away'])->get();

        $enrollments = Enrollment::get();

        return view('admin.matches.index', compact('matches', 'enrollments'));
    }

    public function create()
    {
        abort_if(Gate::denies('match_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locals = Enrollment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aways = Enrollment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.matches.create', compact('locals', 'aways'));
    }

    public function store(StoreMatchRequest $request)
    {
        $match = Matche::create($request->all());

        return redirect()->route('admin.matches.index');
    }

    public function edit(Matche $match)
    {
        abort_if(Gate::denies('match_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locals = Enrollment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aways = Enrollment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $match->load('local', 'away');

        return view('admin.matches.edit', compact('locals', 'aways', 'match'));
    }

    public function update(UpdateMatchRequest $request, Matche $match)
    {
        $match->update($request->all());

        return redirect()->route('admin.matches.index');
    }

    public function show(Matche $match)
    {
        abort_if(Gate::denies('match_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $match->load('local', 'away', 'matchEvents');
        $matches = Matche::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.matches.show', compact('match', 'matches'));
    }

    public function destroy(Matche $match)
    {
        abort_if(Gate::denies('match_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $match->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatchRequest $request)
    {
        Matche::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
