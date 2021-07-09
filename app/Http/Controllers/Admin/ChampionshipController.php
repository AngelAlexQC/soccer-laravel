<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChampionshipRequest;
use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Models\Category;
use App\Models\Championship;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChampionshipController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('championship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championships = Championship::with(['category'])->get();

        $categories = Category::get();

        return view('admin.championships.index', compact('championships', 'categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('championship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.championships.create', compact('categories'));
    }

    public function store(StoreChampionshipRequest $request)
    {
        $championship = Championship::create($request->all());

        return redirect()->route('admin.championships.index');
    }

    public function edit(Championship $championship)
    {
        abort_if(Gate::denies('championship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $championship->load('category');

        return view('admin.championships.edit', compact('categories', 'championship'));
    }

    public function update(UpdateChampionshipRequest $request, Championship $championship)
    {
        $championship->update($request->all());

        return redirect()->route('admin.championships.index');
    }

    public function show(Championship $championship)
    {
        abort_if(Gate::denies('championship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championship->load('category', 'championshipEnrollments');

        return view('admin.championships.show', compact('championship'));
    }

    public function destroy(Championship $championship)
    {
        abort_if(Gate::denies('championship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championship->delete();

        return back();
    }

    public function massDestroy(MassDestroyChampionshipRequest $request)
    {
        Championship::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
