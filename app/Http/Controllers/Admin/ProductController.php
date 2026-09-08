<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => Product::all(),
        ], Response::HTTP_OK);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully.',
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'message' => 'Product retrieved successfully.',
            'data' => $product,
        ], Response::HTTP_OK);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => $product,
        ], Response::HTTP_OK);
    }
}
