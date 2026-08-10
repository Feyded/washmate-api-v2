<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Product::all(),
        ]);
    }

    public function store(CreateProductFormRequest $request)
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

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'message' => 'Product Updated Successfully',
            'data' => $product,
        ]);
    }
}
