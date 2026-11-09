<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicOrderController;
use App\Http\Controllers\AdminProductController;

Route::get('/', function () {
    return inertia('Welcome');
});


// Public Catalog & Guest Checkout Routes

Route::get('/Catalog', [PublicOrderController::class, 'catalog'])->name('catalog.index');
Route::post('/checkout', [PublicOrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order/confirmation/{orderNumber}', [PublicOrderController::class, 'confirmation'])->name('order.confirmation');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});
