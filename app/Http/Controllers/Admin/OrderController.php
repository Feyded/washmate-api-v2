<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Orders retrieved successfully.',
            'data' => Order::all(),
        ], Response::HTTP_OK);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $data = Order::create($request->validated());

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $data,
        ], Response::HTTP_CREATED);
    }
}
