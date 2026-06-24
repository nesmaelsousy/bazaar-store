<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')->Filter($request->all())->paginate(10);

        return view('dashboard.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::where('role', 'client')->where('status', 'active')->pluck('name', 'id')->toArray();
        $sellers = User::where('role', 'craftsmen')->where('status', 'active')->pluck('name', 'id')->toArray();
        $products = Product::where('status', 'active')->first();
        $order = new Order();
        //   event(new OrderCreated($items, $order));
        return view('dashboard.orders.add', compact('users', 'sellers', 'products', 'order'));
    }

    public function store(StoreOrderRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        Order::create($data);
        return redirect()->route('admin.order.index');
    }

    public function edit(Order $order)
    {
        $users = User::where('role', 'client')->where('status', 'active')->pluck('name', 'id')->toArray();
        $sellers = User::where('role', 'craftsmen')->where('status', 'active')->pluck('name', 'id')->toArray();
        $products = Product::where('status', 'active')->first();
        return view('dashboard.orders.edit', compact('order','users','sellers','products'));
    }

    public function update(StoreOrderRequest $request , Order $order)
    {
        $data = $request->validated();
        $order->update($data);
        return redirect()->route('admin.order.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return  redirect()->route('admin.order.index');;
    }
    public function pinding(){
        $orders = Order::where('status','pending')->paginate(10);
        return view('dashboard.orders.pinding',compact('orders'));
    }
     public function complete(){
        $orders = Order::where('status','completed')->paginate(10);
        return view('dashboard.orders.complete',compact('orders'));
    }
}
