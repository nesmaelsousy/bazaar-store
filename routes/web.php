<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\CartController;
use App\Http\Controllers\site\CheckoutController;
use App\Http\Controllers\site\HomeController;
use App\Http\Controllers\site\ProductController;

Route::name('frontend.')->group(function () {
      
 Route::get('/home',[HomeController::class,'index'])->name('index');
 Route::get('/products',[ProductController::class,'index'])->name('products.show');
 Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
 Route::resource('/cart',CartController::class);
 Route::resource('/checkout',CheckoutController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
