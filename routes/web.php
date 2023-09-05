<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyCommerceController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [MyCommerceController::class, 'index'])->name('home');
Route::get('/product-category', [MyCommerceController::class, 'category'])->name('product-category');
Route::get('/product-detail', [MyCommerceController::class, 'detail'])->name('product-detail');

// Cart Route
Route::get('/view-cart', [CartController::class, 'index'])->name('view-cart');

// Checkout Route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


