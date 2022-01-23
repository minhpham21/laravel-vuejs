<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Category extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:25|unique:categories',
            'description' => 'nullable|max:100',
            'active' => 'required|boolean',
        ];
    }
}
