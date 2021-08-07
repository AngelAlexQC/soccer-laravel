<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Http\Resources\Admin\ClubResource;
use App\Models\Club;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ClubApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClubResource(Club::with(['category'])->get());
    }

    public function store(StoreClubRequest $request)
    {
        $club = Club::create($request->all());

        if ($request->input('picture', false)) {
            $club->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

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

        if ($request->input('picture', false)) {
            if (!$club->picture || $request->input('picture') !== $club->picture->file_name) {
                if ($club->picture) {
                    $club->picture->delete();
                }
                $club->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
            }
        } elseif ($club->picture) {
            $club->picture->delete();
        }

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
