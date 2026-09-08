<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandFormRequest;
use App\Http\Requests\Admin\UpdateBrandFormRequest;
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

    public function store(StoreBrandFormRequest $request): JsonResponse
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

    public function update(UpdateBrandFormRequest $request, Brand $brand): JsonResponse
    {
        $brand->update($request->validated());

        return response()->json([
            'message' => 'Brand updated successfully.',
            'data' => $brand,
        ], Response::HTTP_OK);
    }
}
