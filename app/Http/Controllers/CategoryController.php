<?php

namespace App\Http\Controllers;

use Exception;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category as CategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();
        $limit = (is_numeric($request->limit)) ? (int) $request->limit : 10;
        $categories = Category::orderBy('id', 'asc')
            ->paginate($limit);

        return view('category.index')
            ->with([
                'categories' => $categories,
                'total' => $categories->total(),
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

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        try {
            $rules = [
                'title' => [
                    'required',
                    Rule::unique('categories')->ignore($category),
                ],
                'description' => 'nullable|max:100',
                'active' => 'required|boolean',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $category->update([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active,
            ]);
            Session::flash('success', trans('category.message.was_updated'));
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('category.message.try_again'));
        }
    }

    // public function destroy($id)
    // {
    //     //
    // }
}
