<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadController;
use App\Livewire\Counter;

// Home
Route::get('/', function(){
    return view('home');
})->name('home');

// Users
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/{id}', [UserController::class, 'details'])->name('user.details');

// Cart
Route::any('cart', [CartController::class, 'index'])->name('cart.index');
Route::name('cart.')->group(function(){
    Route::post('cart/addProduct', [CartController::class, 'addProduct'])->name('addProduct');
    Route::post('cart/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('checkout');
});

// Downloads
Route::name('download.')->group(function(){
    Route::get('download/csv', [DownloadController::class, 'downloadCsv'])->name('csv');
    Route::get('download/pdf', [DownloadController::class, 'downloadPdf'])->name('pdf');
});

// Products
Route::resource('products', ProductController::class);
Route::get('products/search', [ProductController::class, 'search'])->name('products.search');