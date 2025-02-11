<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductAPIController;
use App\Http\Controllers\UserAPIController;
use App\Models\Product;

Route::any('products', [ProductAPIController::class, 'index']);

Route::prefix('products')->group(function()
{
    Route::get('{id}', [ProductAPIController::class, 'show']);

    Route::middleware('auth:sanctum')->put('create', [ProductAPIController::class, 'store']);

    Route::middleware('auth:sanctum')->patch('{id}', [ProductAPIController::class, 'update']);

    Route::delete('{id}', [ProductAPIController::class, 'destroy']);
});

Route::any('users', [UserAPIController::class, 'index']);

Route::prefix('users')->group(function()
{
    Route::get('{id}', [UserAPIController::class, 'show']);
});