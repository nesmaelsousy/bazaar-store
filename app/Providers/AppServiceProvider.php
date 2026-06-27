<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\View;
use App\Models\cart;
use App\Models\Contact;

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
            $cart = app()->make('App\Repositories\Cart\CartRepository');
            $count = $cart->count();

            // Messages (new)
            $latestMessages = Contact::latest()->take(5)->get();
            $unreadCount = Contact::where('is_read', false)->count();
            // notification
             $notifications = auth()->user()?->notifications()->limit(10)->get() ?? collect();
            $view->with([
                'count' => $count,
                'latestMessages' => $latestMessages,
                'unreadCount' => $unreadCount,
                'notifications'=>$notifications
            ]);
        });
        Paginator::useBootstrap();
        // Paginator::useTailwind();
    }
}
