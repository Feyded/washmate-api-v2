<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Brand::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = Brand::create($request->all());

        return response()->json([
            'message' => 'Brand Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(Brand $brand)
    {
        return response()->json([
            'data' => $brand,
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());

        return response()->json([
            'message' => 'Brand Updated Successfully',
            'data' => $brand,
        ]);
    }
}
