<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtisanDashboardController;
use App\Http\Controllers\ArtisanOrderController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\ReviewController;
use App\Http\Controllers\Site\StripeController;

Route::name('frontend.')->group(function () {
    // Route::resource('profile', ProfileController::class);

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/artisans', [HomeController::class, 'artisans'])->name('artisans');
    Route::get('/artisan/{artisan}', [ArtisanDashboardController::class, 'show'])->name('artisan.show');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/workshops', [HomeController::class, 'workshops'])->name('workshops');
    Route::name('favorites.')->group(function () {
        Route::get('/favorites', [HomeController::class, 'favorites'])->name('index');
        Route::post('/products/{product}/favorite', [ProductController::class, 'addToFavorites'])->name('toggle');
    });

    Route::get('/products', [ProductController::class, 'index'])->name('products.show');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/products', [CategoryController::class, 'products'])->name('categories.products');
    Route::resource('/cart', CartController::class);
    //checkout 
    Route::resource('/checkout', CheckoutController::class);
    Route::get('/orders/{order}/pay', [StripeController::class, 'create'])->name('payment.create');
    Route::post(
        '/orders/{order}/stripe/payment-intent',
        [StripeController::class, 'createStripePaymentIntent']
    )->name('stripe.paymentIntent.create');
    Route::get('/orders/{order}/pay/stripe/callback', [StripeController::class, 'confirm'])->name('stripe.return');
    //review 
    Route::post('/product/{product}/review', [ReviewController::class, 'store'])->name('product.review');
    Route::resource('/orders', OrderController::class);
});

Route::middleware(['auth'])->group(function () {

    // profile  clint

    Route::prefix('client')->middleware(['role:client'])->name('client.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
       
    });
    // craftsmen  
    Route::prefix('craftsmen')->middleware(['role:craftsmen'])->name('craftsmen.')
        ->group(function () {
            Route::get('/profile', [ArtisanDashboardController::class, 'index'])->name('profile.index');
            Route::resource('/product', ProductController::class);
            Route::patch('/profile', [ArtisanDashboardController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ArtisanDashboardController::class, 'destroy'])->name('profile.destroy');
            Route::resource('/orders', ArtisanOrderController::class);
        });
});

require __DIR__ . '/auth.php';
