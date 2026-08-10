<?php

use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('brands', BrandController::class)->except('destroy');
Route::apiResource('addons', AddonController::class)->except('destroy');
Route::apiResource('products', ProductController::class)->except('destroy');
Route::apiResource('services', ServiceController::class)->except('destroy');
Route::apiResource('service-products', ServiceProductController::class)->except('destroy');
