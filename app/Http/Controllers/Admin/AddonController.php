<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAddonFormRequest;
use App\Http\Requests\Admin\UpdateAddonFormRequest;
use App\Models\addon;

class AddonController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => addon::all(),
        ]);
    }

    public function store(StoreAddonFormRequest $request)
    {
        $data = addon::create($request->validated());

        return response()->json([
            'message' => 'Addon Created Successfully',
            'data' => $data,
        ], 201);
    }

    public function show(addon $addon)
    {
        return response()->json([
            'data' => $addon,
        ]);
    }

    public function update(UpdateAddonFormRequest $request, addon $addon)
    {
        $addon->update($request->validated());

        return response()->json([
            'message' => 'Addon Updated Successfully',
            'data' => $addon,
        ]);
    }
}
