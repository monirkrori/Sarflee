<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

//Routs Regular users
Route::post('register-regular', [AuthController::class, 'registerRegular']);
Route::post('login-regular', [AuthController::class, 'loginRegular']);

//Routs exchange users
Route::post('login-exchange', [AuthController::class, 'loginExchange']);
Route::post('register-exchange', [AuthController::class, 'registerExchange']);

Route::middleware('auth:sanctum')->
post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->
delete('delete', [AuthController::class, 'destroy']);
