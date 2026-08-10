<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => addon::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = addon::create($request->all());

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

    public function update(Request $request, addon $addon)
    {
        $addon->update($request->all());

        return response()->json([
            'message' => 'Addon Updated Successfully',
            'data' => $addon,
        ]);
    }
}
