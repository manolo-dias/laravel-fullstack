<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/list', [ProductController::class, 'list'])->name('products.list');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/search/{query}', [ProductController::class, 'search'])->name('products.search');

});

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/list', [CustomerController::class, 'list'])->name('customer.list');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/search/{query}', [CustomerController::class, 'search'])->name('customer.search');

});

Route::prefix('checkout')->group(function () {
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::delete('/delete/{id}', [CheckoutController::class, 'destroy'])->name('checkout.destroy');
    Route::get('/edit/{id}', [CheckoutController::class, 'edit'])->name('checkout.edit');
    Route::put('/update/{id}', [CheckoutController::class, 'update'])->name('checkout.update');
});
