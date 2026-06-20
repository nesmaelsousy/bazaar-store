<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function create(Order $order)
    {

        return view('frontend.payment.create', compact('order'));
    }

    public function createStripePaymentIntent(Order $order)
    {

        $amount = $order->orderItems()->get()->sum(fn($item) => $item->price * $item->quantity);
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));


        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);
        $payment = new Payment();
        $payment->forceFill([
            'order_id' => $order->id,
            'amount' => $paymentIntent->amount,
            'currency' => $paymentIntent->currency,
            'status' => 'pending',
            'method' => 'stripe',
            'transaction_id' => $paymentIntent->id,
            'transaction_data' => json_encode($paymentIntent)

        ])->save();
        event('payment.crated', $payment->id);

        return [
            'clientSecret' => $paymentIntent->client_secret
        ];
    }
    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));

        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        if ($paymentIntent->status == 'succeeded') {
            $payment = Payment::where('order_id', $order->id)->first();

            $payment->forceFill([
                'status' => 'complete',
                'transaction_data' => json_encode($paymentIntent)
            ])->save();
            $order->update([
                'status' => 'processing'
            ]);
            event('payment.created', $payment->id);
            return redirect()->route('frontend.index')->with('success', 'Payment process completed successfully');
        }
        return redirect()->route('frontend.checkout.create')->with('error', 'Payment failed. Please try again.');
    }
}
