<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Http\Resources\Admin\ChampionshipResource;
use App\Models\Championship;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ChampionshipApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('championship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChampionshipResource(Championship::with(['category'])->get());
    }

    public function store(StoreChampionshipRequest $request)
    {
        $championship = Championship::create($request->all());

        return (new ChampionshipResource($championship))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Championship $championship)
    {
        abort_if(Gate::denies('championship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChampionshipResource($championship->load(['category']));
    }

    public function update(UpdateChampionshipRequest $request, Championship $championship)
    {
        $championship->update($request->all());

        return (new ChampionshipResource($championship))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Championship $championship)
    {
        abort_if(Gate::denies('championship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championship->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
