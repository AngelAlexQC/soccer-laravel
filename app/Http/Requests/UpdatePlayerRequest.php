<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('player_edit');
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
                'unique:players,dni,' . request()->route('player')->id,
            ],
            'birth_date' => [
                'date',
                'required',
            ],
        ];
    }
}
