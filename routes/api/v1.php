<?php

use Illuminate\Support\Facades\Route;

// API Version 1 grouping
Route::prefix('v1')->group(function () {
    require __DIR__ . '/v1/auth.php';
    require __DIR__ . '/v1/exchangeShop.php';
    require __DIR__ . '/v1/rating.php';
});

