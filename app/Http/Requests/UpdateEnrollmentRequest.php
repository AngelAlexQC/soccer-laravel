<?php

namespace App\Http\Requests;

use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEnrollmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enrollment_edit');
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
            ],
            'club_id' => [
                'required',
                'integer',
            ],
            'players.*' => [
                'integer',
            ],
            'players' => [
                'required',
                'array',
            ],
        ];
    }
}
