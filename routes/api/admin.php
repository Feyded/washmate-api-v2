<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api', 'auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::apiResource('brands', BrandController::class)->except('destroy');
        Route::apiResource('products', ProductController::class)->except('destroy');
        Route::apiResource('services', ServiceController::class)->except('destroy');
        Route::apiResource('service-products', ServiceProductController::class)->except('destroy');
    });
