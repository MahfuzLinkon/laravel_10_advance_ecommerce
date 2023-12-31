<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UnitController;
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

// Admin Auth Route
Route::get('/admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login');

Route::group(['middleware' => ['admin.auth'], 'prefix' => 'admin' ,'as' => 'admin.'], function (){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    // Category Route
    Route::resource('categories', CategoryController::class)->parameters([
        'categories' => 'category:slug',
    ]);
    Route::get('categories/status/{category:slug}', [CategoryController::class, 'status'])->name('categories.status');

    // SubCategory Route
    Route::resource('sub-categories', SubCategoryController::class)->parameters([
        'sub-categories' => 'sub-category:slug'
    ]);
    Route::get('/sub-category/status/{subcategory}', [SubCategoryController::class, 'status'])->name('sub-categories.status');

    // Brand Route
    Route::resource('brands', BrandController::class)->parameters([
        'brands' => 'brand:slug'
    ]);
    Route::get('brands/status/{brand:slug}', [BrandController::class, 'status'])->name('brands.status');

    // Unit Route
    Route::resource('units', UnitController::class)->parameters([
        'units' => 'unit:slug'
    ]);
    Route::get('units/status/{unit:slug}', [UnitController::class, 'status'])->name('units.status');

    // Product all route
    Route::resource('products', ProductController::class)->parameters([
        'products' => 'product:slug'
    ]);
    Route::get('/get-sub-category', [ProductController::class, 'getSubcategory'])->name('get-sub-category');
    Route::get('product/status/{product:slug}', [ProductController::class, 'status'])->name('products.status');
});

Route::get('/admin/register', [AdminAuthController::class, 'create'])->name('admin.register');

