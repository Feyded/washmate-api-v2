<?php

namespace App\Http\Controllers\Pos;


use App\Http\Requests\Pos\StoreOrderFormRequest;
use App\Http\Controllers\Controller;
use App\Services\Pos\OrderService;

class OrderController extends Controller
{

    public function __construct(private OrderService $orderService) {}

    public function store(StoreOrderFormRequest $request)
    {
        $validated = $request->validated();

        $order = $this->orderService->create($validated, 1);

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $order
        ]);
    }
}
