<?php

namespace App\Http\Controllers\Pos;

use App\Http\Requests\Pos\StoreOrderFormRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(StoreOrderFormRequest $request)
    {
        $validated = $request->validated();
    }
}
