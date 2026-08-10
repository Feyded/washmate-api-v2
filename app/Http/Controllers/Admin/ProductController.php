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
        return Product::all();
    }

    public function store(CreateProductFormRequest $request)
    {
        $data = Product::create($request->validated());

        return response()->json([
            'message' => 'Product Created Successfully',
            'data' => $data,
        ]);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return $product;
    }
}
