<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductFormRequest;
use App\Http\Requests\Admin\UpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Product::all(),
        ]);
    }

    public function store(StoreProductFormRequest $request): JsonResponse
    {
        $data = Product::create($request->validated());

        return response()->json([
            'message' => 'Product Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product,
        ]);
    }

    public function update(UpdateProductFormRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product Updated Successfully',
            'data' => $product,
        ]);
    }
}
