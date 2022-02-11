<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use App\Helpers\Utils;

class UpdateActive extends Controller
{
    public function __invoke(Category $category)
    {
        try {
            $category->active = $category->active ? false : true;
            $category->save();
            $data = Utils::categoriesMap(Category::get(['id', 'title', 'parent_id' ,'active'])->toArray());

            return response()->json([
                    'success', 200,
                    'data' => $data,
                ]
            );
        } catch (Exception $e) {
            report($e);
            return response('error', 400);
        }
    }
}
