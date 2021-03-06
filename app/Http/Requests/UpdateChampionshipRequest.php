<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateChampionshipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('championship_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:championships,name,' . request()->route('championship')->id,
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
