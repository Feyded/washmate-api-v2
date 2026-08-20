<?php

use App\Http\Controllers\Pos\OrderController;

use Illuminate\Support\Facades\Route;

Route::prefix('pos')
    ->name('pos.')
    ->group(function () {
        Route::post('order', [OrderController::class, 'store']);
    });
