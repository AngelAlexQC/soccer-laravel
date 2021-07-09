<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Http\Resources\Admin\ClubResource;
use App\Models\Club;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClubApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClubResource(Club::with(['category'])->get());
    }

    public function store(StoreClubRequest $request)
    {
        $club = Club::create($request->all());

        return (new ClubResource($club))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Club $club)
    {
        abort_if(Gate::denies('club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClubResource($club->load(['category']));
    }

    public function update(UpdateClubRequest $request, Club $club)
    {
        $club->update($request->all());

        return (new ClubResource($club))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Club $club)
    {
        abort_if(Gate::denies('club_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
