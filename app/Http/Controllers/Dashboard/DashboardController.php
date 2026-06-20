<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        // user 
        $totalCraftsmen = User::where('role', 'craftsmen')->count();
        $totalClient = User::where('role', 'client')->count();
        
        //product
        $totalProduct = Product::count();
        //order
        $totalSales      = Order::where('status', 'completed')->sum('total_price');
        $totalSalesMonth = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_price');
        //admin
        $admin = Admin::all();

        return view('dashboard.index', compact( 'totalProduct', 'totalCraftsmen', 'totalClient', 'admin'));
    }
}
