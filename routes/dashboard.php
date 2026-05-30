<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\Admin\AuthController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\User\UserController;

// // Admin routes
// Admin routes

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('store', StoreController::class);
        Route::resource('order', OrderController::class);
    });



    // Route::prefix('admin')->group(function () {
    //     Route::resource('profile', ProfileController::class);
    // });
});
