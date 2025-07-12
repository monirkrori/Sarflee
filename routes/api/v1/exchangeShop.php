<?php

use App\Http\Controllers\Api\V1\ExchangeShopController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'role:exchange'])->group(function () {
    Route::get('/exchange-shop', [ExchangeShopController::class, 'show']);
    Route::put('/exchange-shop', [ExchangeShopController::class, 'update']);
    Route::delete('/exchange-shop', [ExchangeShopController::class, 'destroy']);
});

Route::get('exchange-shop', [ExchangeShopController::class, 'index'])->middleware('auth:sanctum');


