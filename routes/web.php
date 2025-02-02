<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Livewire\Counter;

// Route::get('counter', Counter::class);

Route::get('/', function(){
    return redirect()->route('products.index');
});

Route::any('cart', [CartController::class, 'index'])->name('cart.index');

Route::name('cart.')->group(function(){
    Route::post('cart/addProduct', [CartController::class, 'addProduct'])->name('addProduct');
    Route::post('cart/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('cart/exportToCSV', [CartController::class, 'exportToCSV'])->name('exportToCSV');
    Route::get('cart/exportToPDF', [CartController::class, 'exportToPDF'])->name('exportToPDF');
});

Route::get('products/exportToCSV', [ProductController::class, 'exportToCSV'])->name('products.exportToCSV');
Route::get('products/exportToPDF', [ProductController::class, 'exportToPDF'])->name('products.exportToPDF');

Route::get('products/search', [ProductController::class, 'search'])->name('products.search');

Route::resource('products', ProductController::class);