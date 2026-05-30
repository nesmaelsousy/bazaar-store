<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       View::composer('*', function ($view) {
        $cartCount = 0;

        // if (Auth::check()) {
        //     // إذا عندك Cart model مرتبط بالـ user
        //     $cartCount = Auth::user()->carts()->sum('quantity');
        //     // أو إذا عندك CartItem
        //     // $cartCount = Auth::user()->cartItems()->count();
        // } else {
        //     // إذا بتخزن الكارت في الـ session
        //     $cartCount = collect(session('cart', []))->sum('quantity');
        // }

        $view->with('cartCount', $cartCount);
    }); 
         Paginator::useBootstrap();
    }
}
 