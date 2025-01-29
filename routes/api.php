<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductResource;
use App\Models\Product;

Route::get('products', [ProductController::class, 'indexAPI']);
Route::put('products/store/{name}/{price}/{description?}', [ProductController::class, 'storeAPI']);
Route::get('products/{id}', [ProductController::class, 'showAPI']);
Route::post('products/update/{id}/{name}/{description}/{price}', [ProductController::class, 'updateAPI']);
Route::delete('products/destroy/{id}', [ProductController::class, 'destroyAPI']);