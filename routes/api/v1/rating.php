<?php

use App\Http\Controllers\Api\V1\RatingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('rating/{id}', [RatingController::class, 'rateShop']);
});
