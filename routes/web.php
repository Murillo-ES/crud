<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function(){
    return redirect()->route('products.index');
});

Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::name('cart.')->group(function(){
    Route::post('cart/addProduct', [CartController::class, 'addProduct'])->name('addProduct');
    Route::post('cart/removeProduct', [CartController::class, 'removeProduct'])->name('removeProduct');
});

Route::resource('products', ProductController::class);