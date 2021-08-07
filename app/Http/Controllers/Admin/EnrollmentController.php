<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnrollmentRequest;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Championship;
use App\Models\Club;
use App\Models\Enrollment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

        return view('admin.enrollments.index', compact('enrollments', 'championships', 'clubs', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('enrollment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championships = Championship::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $players = User::all()->pluck('name', 'id');

        return view('admin.enrollments.create', compact('championships', 'clubs', 'players'));
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = Enrollment::firstOrCreate([
            'championship_id' => $request->championship_id,
            'club_id' => $request->club_id,
        ]);
        $players = User::all()->map(function ($player) use ($enrollment, $request) {
            $age = Carbon::createFromFormat('d-m-Y', $player->birthdate)->age;
            if (is_array($request->players)) {
                foreach ($request->players as $p) {
                    if (
                        $player->id != $p &&
                        $age > $enrollment->club->category->min_age &&
                        $age < $enrollment->club->max_age &&
                        count($player->playersEnrollments
                            ->where(
                                'championship_id',
                                $enrollment->championship_id
                            )) == 0
                    ) {
                        return $player;
                    }
                }
            }
        });

        $enrollment->players()->sync($request->input('players', []));

        return redirect()->route('admin.enrollments.edit', ['enrollment' => $enrollment->id]);
    }

    public function edit(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $championships = Championship::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $players = User::all()->map(function ($player) use ($enrollment) {
            $age = Carbon::createFromFormat('d-m-Y', $player->birthdate)->age;
            if (
                $age - $enrollment->club->category->min_age > 0 &&
                $enrollment->club->category->max_age > $age &&
                count(
                    $player->playersEnrollments
                        ->where(
                            'championship_id',
                            $enrollment->championship_id
                        )
                ) == 0
            ) {
                return $player;
            }
        });
        $players = $players->merge($enrollment->players)->pluck('name', 'id');
        $enrollment->load('championship', 'club', 'players');

        return view('admin.enrollments.edit', compact('championships', 'clubs', 'players', 'enrollment'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->all());
        $enrollment->players()->sync($request->input('players', []));

        return redirect()->route('admin.enrollments.index');
    }

    public function show(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->load('championship', 'club', 'players', 'localMatches', 'awayMatches');

        return view('admin.enrollments.show', compact('enrollment'));
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
