<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Filterable;

class Category extends Model
{
    use Filterable;

    protected $guarded = ['id'];
    protected $filterable = [
        'id'
    ];

}
