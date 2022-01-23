<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;

class UpdateActive extends Controller
{
    public function __invoke(Category $category)
    {
        try {
            //code...
            $category->active = $category->active ? false : true;
            $category->save();
            return response('success', 200);
        } catch (Exception $e) {
            report($e);
            return response('error', 400);
        }
    }
}
