<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/products', 'products')->name('products');
Route::view('/products/search','products-search');

Route::view('/customers','customers-register');
Route::view('/customers/search','customers-search');

Route::view('/sales','sales');

// Route for products
// Route::resource('products', ProductController::class);

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
