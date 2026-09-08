<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrderFormRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Order::all(),
        ]);
    }

    public function store(StoreOrderFormRequest $request): JsonResponse
    {
        $data = Order::create($request->validated());

        return response()->json([
            'message' => 'Order Created Successfully',
            'data' => $data,
        ], 201);
    }
}
