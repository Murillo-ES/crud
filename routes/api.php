<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductAPI;
use App\Http\Resources\ProductResource;
use App\Models\Product;

Route::any('products', [ProductAPI::class, 'index']);

Route::prefix('products')->group(function()
{
    Route::get('{id}', [ProductAPI::class, 'show']);

    Route::put('create', [ProductAPI::class, 'store']);

    Route::patch('{id}', [ProductAPI::class, 'update']);

    Route::delete('{id}', [ProductAPI::class, 'destroy']);
});