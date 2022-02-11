<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Category extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoresIds =  \App\Category::get()->pluck('id');
        return [
            'title' => 'required|max:25|unique:categories',
            'description' => 'nullable|max:100',
            'active' => 'required|boolean',
            'parent_id' => [
                'nullable',
                'integer',
                Rule::in($categoresIds)
            ]
        ];
    }

    public function attributes()
    {
        return [
            'parent_id' => 'category',
        ];
    }
}
