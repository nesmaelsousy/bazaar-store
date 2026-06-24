<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderPlacedToSellerNotification;
use App\Notifications\OrderSentToSellerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderConfirmed $event): void
    {
        $order = $event->order;
        $seller = $order->seller;
        // user
        $user = $order->user;
        $admins = Admin::all();

        if ($seller) {
            Notification::send($seller, new NewOrderNotification($order));
        }
        if ($admins->count()) {
            Notification::send($admins, new OrderPlacedToSellerNotification($order, $user));
        }
        if ($user) {
            Notification::send(
                $user,
                new OrderSentToSellerNotification($order)
            );
        }
    }
}
