<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChampionshipRequest;
use App\Http\Requests\StoreChampionshipRequest;
use App\Http\Requests\UpdateChampionshipRequest;
use App\Models\Category;
use App\Models\Championship;
use App\Models\Matche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        // Sort by desc
        $orderedChampionshipEnrollments = $championship->championshipEnrollments->sortByDesc('points');

        return view('admin.championships.show', compact('championship', 'orderedChampionshipEnrollments'));
    }

    public function generate($id)
    {
        $championship = Championship::findOrFail($id);
        $clubs = $championship->championshipEnrollments->toArray();
        $rounds = $this->generateFixtures($clubs, $championship);

        return back()->with(
            'message',
            count($rounds) > 0 ? 'Partidos generados con éxito' : 'Debe haber un número par de equipos'
        );
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

    public function generateFixtures(array $clubs, Championship $championship, $includeReverseFixtures = false)
    {
        $rondas = [];
        $numEquipos = count($clubs);
        Matche::where('championship_id', $championship->id)->delete();
        if ($numEquipos % 2 == 0) {
            // Delete al matches of championship

            // Generate the fixtures using the cyclic algorithm.
            $numRondas = $numEquipos - 1;
            $numPartidosPorRonda = $numEquipos / 2;

            for ($i = 0, $k = 0; $i < $numRondas; $i++) {
                for ($j = 0; $j < $numPartidosPorRonda; $j++) {
                    $rondas[$i][$j] = [];
                    $rondas[$i][$j]['local_id'] = $k;
                    $k++;
                    if ($k == $numRondas) {
                        $k = 0;
                    }
                }
            }
            for ($i = 0; $i < $numRondas; $i++) {
                if ($i % 2 == 0) {
                    $rondas[$i][0]['away_id'] = $numEquipos - 1;
                } else {
                    $rondas[$i][0]['away_id'] = $rondas[$i][0]['local_id'];
                    $rondas[$i][0]['local_id'] = $numEquipos - 1;
                }
            }
            $equipoMasAlto = $numEquipos - 1;
            $equipoImparMasAlto = $equipoMasAlto - 1;

            for ($i = 0, $k = $equipoImparMasAlto; $i < $numRondas; $i++) {
                for ($j = 1; $j < $numPartidosPorRonda; $j++) {
                    $rondas[$i][$j]['away_id'] = $k;
                    $k--;
                    if ($k == -1) {
                        $k = $equipoImparMasAlto;
                    }
                }
            }
        }
        $enrollments = $championship->championshipEnrollments;
        for ($i = 0; $i < count($rondas); $i++) {
            for ($j = 0; $j < count($rondas[$i]); $j++) {
                Matche::create([
                    'local_id' => intval($enrollments[$rondas[$i][$j]['local_id']]->id),
                    'away_id' => intval($enrollments[$rondas[$i][$j]['away_id']]->id),
                    'championship_id' => $championship->id,
                    'round' => $i + 1,
                ]);
            }
        }

        return $rondas;
    }
}
