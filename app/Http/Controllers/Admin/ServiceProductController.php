<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProduct;
use Illuminate\Http\Request;

class ServiceProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => ServiceProduct::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = ServiceProduct::create($request->all());

        return response()->json([
            'message' => 'Service Product Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(ServiceProduct $serviceProduct)
    {
        return response()->json([
            'data' => $serviceProduct,
        ]);
    }

    public function update(Request $request, ServiceProduct $serviceProduct)
    {
        $serviceProduct->update($request->all());

        return response()->json([
            'message' => 'Service Product Updated Successfully',
            'data' => $serviceProduct,
        ]);
    }
}
