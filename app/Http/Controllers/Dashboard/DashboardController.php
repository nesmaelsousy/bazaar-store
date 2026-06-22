<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // USERS
        $totalCraftsmen = User::where('role', 'craftsmen')->count();
        $totalClient = User::where('role', 'client')->count();

        // PRODUCTS
        $totalProduct = Product::count();

        // SALES TOTAL
        $totalSales = Order::where('status', 'completed')->sum('total_price');

        // SALES THIS MONTH
        $totalSalesMonth = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_price');

        // TARGET (غيره براحتك)
        $monthlyTarget = 12000;

        $salesProgress = $monthlyTarget > 0
            ? min(100, ($totalSalesMonth / $monthlyTarget) * 100)
            : 0;

        // LAST MONTH SALES (for growth)
        $lastMonthSales = Order::where('status', 'completed')
            ->whereBetween(
                'created_at',
                [
                    $now->copy()->subMonth()->startOfMonth(),
                    $now->copy()->subMonth()->endOfMonth()
                ]
            )
            ->sum('total_price');

        $growth = $lastMonthSales > 0
            ? (($totalSalesMonth - $lastMonthSales) / $lastMonthSales) * 100
            : 0;

        // ORDERS
        $pendingOrders = Order::where('status', 'pending')->count();

        $recentOrders = Order::latest()
            ->with('craftsman')
            ->paginate(10);

        return view('dashboard.index', compact(
            'totalProduct',
            'totalSales',
            'totalSalesMonth',
            'totalCraftsmen',
            'totalClient',
            'admin',
            'recentOrders',
            'salesProgress',
            'growth',
            'pendingOrders'
        ));
    }
}