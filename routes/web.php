<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicOrderController;

Route::get('/', function () {
    return inertia('Welcome');
});


// Public Catalog & Guest Checkout Routes

Route::get('/Catalog', [PublicOrderController::class, 'catalog'])->name('catalog.index');
Route::post('/checkout', [PublicOrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order/confirmation/{orderNumber}', [PublicOrderController::class, 'confirmation'])->name('order.confirmation');

