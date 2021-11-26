<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePlayerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'dni' => [
                'string',
                'min:10',
                'max:10',
                'required',
                'unique:users',
            ],
            'birthdate' => [
                'date',
                'required',
            ],
        ];
    }
}
