<?php

namespace App\Http\Requests;

use App\Models\Enrollment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enrollment_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'championship_id' => [
                'required',
                'integer',
                Rule::unique('enrollments')->where(function ($query) {
                    return $query->where('championship_id', $this->championship_id)
                        ->where('club_id', $this->club_id);
                })
            ],
            'club_id' => [
                'required',
                'integer',
            ],
            'players.*' => [
                'integer',
            ],
            'players' => [
                'array',
            ],
        ];
    }
    public function messages()
    {
        return [
            'championship_id.unique' => 'El Equipo ya fue inscrito en este campeonato!',
        ];
    }
}
