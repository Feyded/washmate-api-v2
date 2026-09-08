<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Services retrieved successfully.',
            'data' => Service::all(),
        ], Response::HTTP_OK);
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $data = Service::create($request->validated());

        return response()->json([
            'message' => 'Service created successfully.',
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json([
            'message' => 'Service retrieved successfully.',
            'data' => $service,
        ], Response::HTTP_OK);
    }

    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $service->update($request->validated());

        return response()->json([
            'message' => 'Service updated successfully.',
            'data' => $service,
        ], Response::HTTP_OK);
    }
}
