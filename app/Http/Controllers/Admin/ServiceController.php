<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceFormRequest;
use App\Http\Requests\Admin\UpdateServiceFormRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Service::all(),
        ]);
    }

    public function store(StoreServiceFormRequest $request)
    {
        $data = Service::create($request->validated());

        return response()->json([
            'message' => 'Service Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(Service $service)
    {
        return response()->json([
            'data' => $service,
        ]);
    }

    public function update(UpdateServiceFormRequest $request, Service $service)
    {
        $service->update($request->validated());

        return response()->json([
            'message' => 'Service Updated Successfully',
            'data' => $service,
        ]);
    }
}
