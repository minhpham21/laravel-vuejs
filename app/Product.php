<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function getUrlImages()
    {
        $urlImages = [];
        foreach ($this->images as $image) {
            if (Storage::disk('public')->exists('images/'.$image)) {
                $urlImages[] = Storage::url('images/'.$image);
            }
        }
        return $urlImages;
    }

    public function getImagesAttribute()
    {
        return json_decode($this->attributes['images']);
    }

    public function setImagesAttribute($value){
        return $this->attributes['images'] = json_encode($value);
    }
}