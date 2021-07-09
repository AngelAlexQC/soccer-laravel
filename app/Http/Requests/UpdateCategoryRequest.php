<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:categories,name,' . request()->route('category')->id,
            ],
            'min_age' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'max_age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
