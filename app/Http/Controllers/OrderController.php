<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrderFormRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Order::all(),
        ]);
    }

    public function store(StoreOrderFormRequest $request)
    {
        $data = Order::create($request->validated());

        return response()->json([
            'message' => 'Order Created Successfully',
            'data' => $data,
        ], 201);
    }
}
