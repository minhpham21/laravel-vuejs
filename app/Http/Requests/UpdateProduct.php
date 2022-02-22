<?php

namespace App\Http\Requests;
use Illuminate\Http\UploadedFile;

class UpdateProduct extends Product
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'remove_old_img' => json_decode($this->remove_old_img),
        ]);
    }

    public function rules()
    {
        $totalRemoveImg = count($this->remove_old_img);
        $nullable = $this->remove_old_img && count($this->product->images) == $totalRemoveImg
            ? 'required' 
            : 'nullable';
        $rules = [
            'remove_old_img' => 'nullable|array',
            'remove_old_img.*' => 'nullable|string',
            'images' =>  $nullable . '|array',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:5000'
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function images(): ?array
    {
        return $this->file('images');
    }

    public function remove_old_img(): ?array
    {
        # code...
        return $this->input('remove_old_img');
    }
}
