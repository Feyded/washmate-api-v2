<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceProductFormRequest;
use App\Http\Requests\Admin\UpdateServiceProductFormRequest;
use App\Models\ServiceProduct;

class ServiceProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => ServiceProduct::all(),
        ]);
    }

    public function store(StoreServiceProductFormRequest $request)
    {
        $data = ServiceProduct::create($request->validated());

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

    public function update(UpdateServiceProductFormRequest $request, ServiceProduct $serviceProduct)
    {
        $serviceProduct->update($request->validated());

        return response()->json([
            'message' => 'Service Product Updated Successfully',
            'data' => $serviceProduct,
        ]);
    }
}
