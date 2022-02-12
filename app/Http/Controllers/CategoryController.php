<?php

namespace App\Http\Controllers;

use Exception;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCategory;
use App\Helpers\Utils;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();
        $params = [
            'category_id' => $request->input('category_id') ?? null,
            'active' => $request->input('active') ?? null,
            'limit' => (is_numeric($request->limit)) ? (int) $request->limit : 15,
        ];

        $categories = Category::orderBy('id', 'desc')
            ->filter($params)
            ->paginate($params['limit']);

        return view('category.index')
            ->with([
                'categoryList' => Category::all()->pluck('title', 'id')->toArray(),
                'categories' => $categories,
                'total' => $categories->total(),
                'params' => $params,
                'categoriesMap' => Utils::categoriesMap(Category::get(['id', 'title', 'parent_id' ,'active'])->toArray()),
            ]);
    }

    public function create()
    {
        return view('category.create', [
            'categoryList' => Category::all()->pluck('title', 'id')->toArray()
        ]);
    }

    public function store(StoreCategory $request)
    {
        try {
            Category::create([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active,
                'parent_id' => $request->parent_id
            ]);
            Session::flash('success', trans('category.message.was_created'));
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('category.message.try_again'));
        }
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
            'categoryList' => Category::get()->pluck('title', 'id')->toArray(),
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
                'parent_id' => [
                    'nullable',
                    'integer',
                    Rule::in($category->get()->pluck('id'))
                ],
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
                'parent_id' => $request->parent_id,
            ]);
            Session::flash('success', trans('category.message.was_updated'));
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('category.message.try_again'));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Session::flash('success', trans('category.message.was_deleted'));
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('category.message.try_again'));
        }

        return back();
    }
}
