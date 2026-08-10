<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index()
    {
        return addon::all();
    }

    public function store(Request $request)
    {
        return addon::create($request->all());
    }

    public function show(addon $addon)
    {
        return $addon;
    }

    public function update(Request $request, addon $addon)
    {
        $addon->update($request->all());

        return $addon;
    }
}
