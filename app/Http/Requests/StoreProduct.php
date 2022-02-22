<?php

namespace App\Http\Requests;

class StoreProduct extends Product
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,svg|max:5000'
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function images(): array
    {
        return $this->file('images.*');
    }
}
