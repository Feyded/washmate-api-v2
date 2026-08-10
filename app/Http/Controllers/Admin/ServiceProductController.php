<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProduct;
use Illuminate\Http\Request;

class ServiceProductController extends Controller
{
    public function index()
    {
        return ServiceProduct::all();
    }

    public function store(Request $request)
    {
        return ServiceProduct::create($request->all());
    }

    public function show(ServiceProduct $serviceProduct)
    {
        return $serviceProduct;
    }

    public function update(Request $request, ServiceProduct $serviceProduct)
    {
        $serviceProduct->update($request->all());

        return $serviceProduct;
    }
}
