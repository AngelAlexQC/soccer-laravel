<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('match_create');
    }

    public function rules()
    {
        return [
            'local_id' => [
                'required',
                'integer',
            ],
            'away_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
