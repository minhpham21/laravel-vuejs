<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategory extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('categories')->ignore($this->category),
            ],
            'description' => 'nullable|max:100',
            'parent_id' => [
                'nullable',
                'integer',
                Rule::in($this->category->get()->pluck('id'))
            ],
            'active' => 'required|boolean',
        ];
    }
}
