<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductAPI;
use App\Http\Resources\ProductResource;
use App\Models\Product;

Route::get('products', [ProductAPI::class, 'index']);

Route::prefix('products')->group(function()
{
    Route::get('getById/{id}', [ProductAPI::class, 'showById']);
    Route::get('getByName/{name}', [ProductAPI::class, 'showByName']);
    Route::get('getByPrice/{price}', [ProductAPI::class, 'showByPrice']);

    Route::put('store/{name}/{price}/{description?}', [ProductAPI::class, 'store']);

    Route::prefix('update')->group(function(){
        Route::prefix('name')->group(function(){
            Route::post('byId/{id}/{newName}', [ProductAPI::class, 'updateNameById']);
            Route::post('byName/{name}/{newName}', [ProductAPI::class, 'updateNameByName']);
        });

        Route::prefix('description')->group(function(){
            Route::post('byId/{id}/{newDescription}', [ProductAPI::class, 'updateDescriptionById']);
            Route::post('byName/{name}/{newDescription}', [ProductAPI::class, 'updateDescriptionByName']);
        });

        Route::prefix('price')->group(function(){
            Route::post('byId/{id}/{newPrice}', [ProductAPI::class, 'updatePriceById']);
            Route::post('byName/{name}/{newPrice}', [ProductAPI::class, 'updatePriceByName']);
        });
    });

    Route::prefix('destroy')->group(function(){
        route::delete('byId/{id}', [ProductAPI::class, 'destroyById']);
        route::delete('byName/{name}', [ProductAPI::class, 'destroyByName']);
    });
});