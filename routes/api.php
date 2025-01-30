<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductAPIController;
use App\Http\Resources\ProductResource;
use App\Models\Product;

Route::any('products', [ProductAPIController::class, 'index']);

Route::prefix('products')->group(function()
{
    Route::get('{id}', [ProductAPIController::class, 'show']);

    Route::put('create', [ProductAPIController::class, 'store']);

    Route::patch('{id}', [ProductAPIController::class, 'update']);

    Route::delete('{id}', [ProductAPIController::class, 'destroy']);
});