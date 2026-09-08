<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceProductRequest;
use App\Http\Requests\Admin\UpdateServiceProductRequest;
use App\Models\ServiceProduct;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ServiceProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Service products retrieved successfully.',
            'data' => ServiceProduct::all(),
        ], Response::HTTP_OK);
    }

    public function store(StoreServiceProductRequest $request): JsonResponse
    {
        $data = ServiceProduct::create($request->validated());

        return response()->json([
            'message' => 'Service product created successfully.',
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    public function show(ServiceProduct $serviceProduct): JsonResponse
    {
        return response()->json([
            'message' => 'Service product retrieved successfully.',
            'data' => $serviceProduct,
        ], Response::HTTP_OK);
    }

    public function update(UpdateServiceProductRequest $request, ServiceProduct $serviceProduct): JsonResponse
    {
        $serviceProduct->update($request->validated());

        return response()->json([
            'message' => 'Service product updated successfully.',
            'data' => $serviceProduct,
        ], Response::HTTP_OK);
    }
}
