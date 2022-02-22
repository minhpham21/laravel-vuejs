<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use  App\Jobs\StoreProduct as StoreProductJob;
use  App\Jobs\UpdateProduct as UpdateProductJob;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Product as ProductResource;

use Exception;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();
        $params = [
            'limit' => (is_numeric($request->limit)) ? (int) $request->limit : 15,
        ];

        $products = Product::orderBy('id', 'desc')
            ->paginate($params['limit']);

        return view('product.index', [
            'products' => $products,
            'total' => $products->total(),
            'params' => $params,
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'categoryList' => Category::where('active', 1)->pluck('title', 'id')->toArray(),
        ]);
    }

    public function store(StoreProduct $request)
    {
        try {
            DB::beginTransaction();
            $this->dispatchNow(StoreProductJob::fromRequest($request));
            DB::commit();
            Session::flash('success', trans('product.message.was_created'));
            return response()->json([
                'redirect' => route('admin.products.index'),
            ]);
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('product.message.try_again'));
        }
    }

    public function edit(Product $product)
    {
        return view('product.edit',[
            'productData' => new ProductResource($product),
            'categoryList' => Category::where('active', 1)->pluck('title', 'id')->toArray(),
            'formAction' => route('admin.products.update', ['product' => $product])
        ]);
    }

    public function update(UpdateProduct $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $this->dispatch(UpdateProductJob::fromRequest($product, $request));
            DB::commit();
            Session::flash('success', trans('product.message.was_created'));
            return response()->json([
                'redirect' => route('admin.products.index'),
            ]);
        } catch (Exception $e) {
            report($e);
            Session::flash('error', trans('product.message.try_again'));
        }
    }

    // public function destroy($id)
    // {
    //     //
    // }
}
