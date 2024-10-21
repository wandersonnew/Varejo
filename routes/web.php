<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/products', 'products')->name('products');
    Route::view('/customers', 'customers-register');
    Route::view('/sales', 'sales')->name('sales');
});

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


// API Routes
Route::middleware('api')->group(function () {
    Route::get('/api/orderitens/{saleid}', [CustomerController::class,'checkOrderItems'])->name('checkorderitens');
});
    

require __DIR__.'/auth.php';
