<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Http\Resources\Admin\MatchResource;
use App\Models\Matche;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatchApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('match_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatchResource(Matche::with(['local', 'away'])->get());
    }

    public function store(StoreMatchRequest $request)
    {
        $match = Matche::create($request->all());

        return (new MatchResource($match))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Match $match)
    {
        abort_if(Gate::denies('match_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatchResource($match->load(['local', 'away']));
    }

    public function update(UpdateMatchRequest $request, Match $match)
    {
        $match->update($request->all());

        return (new MatchResource($match))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Match $match)
    {
        abort_if(Gate::denies('match_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $match->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
