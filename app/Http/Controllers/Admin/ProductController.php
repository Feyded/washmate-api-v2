<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductFormRequest;
use App\Http\Requests\Admin\UpdateProductFormRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Product::all(),
        ]);
    }

    public function store(StoreProductFormRequest $request)
    {
        $data = Product::create($request->validated());

        return response()->json([
            'message' => 'Product Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json([
            'data' => $product,
        ]);
    }

    public function update(UpdateProductFormRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product Updated Successfully',
            'data' => $product,
        ]);
    }
}
