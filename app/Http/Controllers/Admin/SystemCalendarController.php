<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championship;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Matche',
            'date_field' => 'start_date',
            'field'      => 'name',
            'prefix'     => 'El partido',
            'suffix'     => 'se juega hoy.',
            'route'      => 'admin.matches.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }
        $championships = Championship::all();
        return view('admin.calendar.calendar', compact('events', 'championships'));
    }

    public function show($id)
    {
        $championships = Championship::all();
        $championship = Championship::findOrFail($id);
        $championship->load('category', 'championshipEnrollments');
        // Sort by desc
        $orderedChampionshipEnrollments = $championship->championshipEnrollments->sortByDesc('points');
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.show', compact(
            'events',
            'championship',
            'orderedChampionshipEnrollments',
            'championships'
        ));
    }
}
