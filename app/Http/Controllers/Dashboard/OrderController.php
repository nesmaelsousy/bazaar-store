<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'store')->paginate(10);
        return view('dashboard.orders.index' , compact('orders'));
    }

    public function create()
    {
        $users = User::get();
        $products = Product::get();
        $order = new Order();
        return view('dashboard.orders.add' , compact('users' , 'products' , 'order'));
    }

    public function store(Request $request)
    {
        return view('dashboard.orders.index');
    }

    public function edit()
    {
        return view('dashboard.orders.add');
    }

    public function update()
    {
        return view('dashboard.orders.index');
    }

    public function destroy()
    {
        return view('dashboard.orders.index');
    }
}
