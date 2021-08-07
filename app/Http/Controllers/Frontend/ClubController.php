<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClubRequest;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Category;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ClubController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clubs = Club::with(['category', 'media'])->get();

        $categories = Category::get();

        return view('frontend.clubs.index', compact('clubs', 'categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('club_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.clubs.create', compact('categories'));
    }

    public function store(StoreClubRequest $request)
    {
        $club = Club::create($request->all());

        if ($request->input('picture', false)) {
            $club->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $club->id]);
        }

        return redirect()->route('frontend.clubs.index');
    }

    public function edit(Club $club)
    {
        abort_if(Gate::denies('club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $club->load('category');

        return view('frontend.clubs.edit', compact('categories', 'club'));
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

        return redirect()->route('frontend.clubs.index');
    }

    public function show(Club $club)
    {
        abort_if(Gate::denies('club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $club->load('category', 'clubEnrollments');

        return view('frontend.clubs.show', compact('club'));
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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('club_create') && Gate::denies('club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Club();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
