<?php

namespace App\Http\Controllers\Pos;


use App\Http\Requests\Pos\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Services\Pos\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    public function __construct(private readonly OrderService $orderService) {}

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        $order = $this->orderService->create($validated, $user);

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => $order
        ], Response::HTTP_CREATED);
    }
}
