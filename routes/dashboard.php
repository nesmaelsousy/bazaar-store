<?php

use App\Http\Controllers\Dashboard\WorkshopsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\Admin\AuthController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\User\UserController;

// // Admin routes
// Admin routes

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::prefix('/dashboard')->middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/deleteImage', [ProfileController::class, 'deleteImage'])->name('deleteImage');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('attribute', AttributeController::class)->except('show');
        Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contacts/{message}/show/', [ContactController::class, 'show'])->name('contact.show');
        Route::post('/contacts/{message}/replay/', [ContactController::class, 'replay'])->name('contact.replay');
        Route::get('order/pend', [OrderController::class, 'pinding'])->name('order.pinding');
        Route::get('order/complete', [OrderController::class, 'complete'])->name('order.complete');
        Route::resource('order', OrderController::class);

        Route::resource('workshop', WorkshopsController::class);
    });



    // Route::prefix('admin')->group(function () {
    //     Route::resource('profile', ProfileController::class);
    // });
});
