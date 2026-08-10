<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandFormRequest;
use App\Http\Requests\Admin\UpdateBrandFormRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Brand::all(),
        ]);
    }

    public function store(StoreBrandFormRequest $request)
    {
        $data = Brand::create($request->validated());

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

    public function update(UpdateBrandFormRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return response()->json([
            'message' => 'Brand Updated Successfully',
            'data' => $brand,
        ]);
    }
}
