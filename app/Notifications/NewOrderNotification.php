<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;
    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
       
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
         $add = $this->order->address;
        return (new MailMessage)
        ->subject('New order'.$this->order->number)
        ->greeting("Hi ,{$notifiable->name}")
            ->line("A new Order (#{$this->order->number}) created by {$add->fullname} from {$add->country}")
            ->action('Notification Action', url('/craftsmen/order'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        $add = $this->order->address;
        return [
            'body' => "A new Order (#{$this->order->number}) created by {$add->fullname} from {$add->country}",
            'icon' => 'fa-solid fa-cart-shopping',
            'url' => url('/craftsmen/orders'),
            'order_id' => $this->order->id
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
