<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Brands retrieved successfully.',
            'data' => Brand::all(),
        ], Response::HTTP_OK);
    }

    public function store(StoreBrandRequest $request): JsonResponse
    {
        $data = Brand::create($request->validated());

        return response()->json([
            'message' => 'Brand created successfully.',
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json([
            'message' => 'Brand retrieved successfully.',
            'data' => $brand,
        ], Response::HTTP_OK);
    }

    public function update(UpdateBrandRequest $request, Brand $brand): JsonResponse
    {
        $brand->update($request->validated());

        return response()->json([
            'message' => 'Brand updated successfully.',
            'data' => $brand,
        ], Response::HTTP_OK);
    }
}
