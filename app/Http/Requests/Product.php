<?php

namespace App\Http\Requests;
use App\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Product extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoryIds = Category::get()->pluck('id');
        return [
            'category_id' => [
                'integer',
                Rule::in($categoryIds)
            ],
            'title' => 'required|max:50',
            'description' => 'required|max:5000',
            'price' => 'required|integer|min:0',
            'active' => 'required|boolean',
        ];
    }

    public function categoryId(): int
    {
        return $this->input('category_id');
    }

    public function title(): string
    {
        return $this->input('title');
    }

    public function description(): string
    {
        return $this->input('description');
    }

    public function price(): int
    {
        return $this->input('price');
    }

    public function active(): bool
    {
        return $this->input('active');
    }
}
