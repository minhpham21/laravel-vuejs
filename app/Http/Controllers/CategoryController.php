<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category as CategoryRequest;
use App\Category;
use Illuminate\Support\Facades\Session;
use Exception;

class CategoryController extends Controller
{
    // public function __construct()
    // {

    // }

    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('category.index')
            ->with([
                'categories' => $categories,
            ]);
    }
    
    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active,
            ]);            
            Session::flash('success', 'test session');
        } catch (Exception $e) {
            report($e);
            Session::flash('error', 'test session');
        }
    }

    // public function edit($id)
    // {
    //     //
    //     return view('category.edit');
    // }

    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // public function destroy($id)
    // {
    //     //
    // }
}
