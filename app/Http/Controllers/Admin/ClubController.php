<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClubRequest;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Category;
use App\Models\Club;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClubController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clubs = Club::with(['category'])->get();

        $categories = Category::get();

        return view('admin.clubs.index', compact('clubs', 'categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('club_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clubs.create', compact('categories'));
    }

    public function store(StoreClubRequest $request)
    {
        $club = Club::create($request->all());

        return redirect()->route('admin.clubs.index');
    }

    public function edit(Club $club)
    {
        abort_if(Gate::denies('club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $club->load('category');

        return view('admin.clubs.edit', compact('categories', 'club'));
    }

    public function update(UpdateClubRequest $request, Club $club)
    {
        $club->update($request->all());

        return redirect()->route('admin.clubs.index');
    }

    public function show(Club $club)
    {
        abort_if(Gate::denies('club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->load('category', 'clubEnrollments');

        return view('admin.clubs.show', compact('club'));
    }

    public function destroy(Club $club)
    {
        abort_if(Gate::denies('club_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->delete();

        return back();
    }

    public function massDestroy(MassDestroyClubRequest $request)
    {
        Club::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
