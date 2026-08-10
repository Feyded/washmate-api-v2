<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = Service::create($request->all());

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

    public function update(Request $request, Service $service)
    {
        $service->update($request->all());

        return response()->json([
            'message' => 'Service Updated Successfully',
            'data' => $service,
        ]);
    }
}
