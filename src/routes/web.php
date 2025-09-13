<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/register', [ProductController::class, 'showRegister']);
Route::post('/products/register', [ProductController::class, 'register']);

Route::get(
    '/products/{productId}',
    [ProductController::class, 'show']
)->name('products.show');
Route::patch('/products/{productId}/update', [ProductController::class, 'update']);
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy']);
