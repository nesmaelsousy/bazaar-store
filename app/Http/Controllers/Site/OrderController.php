<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->latest()->get();
        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $order->load('address');
        return view('frontend.orders.show', compact('order'));
    }

    
}
