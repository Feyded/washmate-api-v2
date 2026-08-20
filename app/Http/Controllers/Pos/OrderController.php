<?php

namespace App\Http\Controllers\Pos;


use App\Http\Requests\Pos\StoreOrderFormRequest;
use App\Http\Controllers\Controller;
use App\Services\Pos\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct(private OrderService $orderService) {}

    public function store(StoreOrderFormRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $order = $this->orderService->create($validated, $user);

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $order
        ]);
    }
}
