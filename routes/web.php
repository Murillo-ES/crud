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
    Route::post('cart/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('cart/exportToCSV', [CartController::class, 'exportToCSV'])->name('exportToCSV');
    Route::get('cart/exportToPDF', [CartController::class, 'exportToPDF'])->name('exportToPDF');
});

Route::get('products/exportToCSV', [ProductController::class, 'exportToCSV'])->name('products.exportToCSV');
Route::get('products/exportToPDF', [ProductController::class, 'exportToPDF'])->name('products.exportToPDF');

Route::resource('products', ProductController::class);