<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreClubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('club_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:clubs',
            ],
            'slug' => [
                'string',
                'min:3',
                'max:3',
                'required',
                'unique:clubs',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
