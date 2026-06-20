<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;

class ArtisanDashboard
{
    private $sellerId;

    public function __construct($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function getAverageReview()
    {
        return ProductReview::whereHas('product', function ($q) {
            $q->where('seller_id', $this->sellerId);
        })->avg('rating');
    }

    public function getTotalOrders()
    {
        return OrderItem::whereHas('order', function ($q) {
            $q->where('seller_id', $this->sellerId);
        })->sum(DB::raw('price * quantity'));
    }

    public function getTopProduct()
    {
        return Product::where('seller_id', $this->sellerId)
            ->withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->first();
    }

    public function getSoldThisMonth()
    {
        $topProduct = $this->getTopProduct();
        
        if (!$topProduct) {
            return 0;
        }

        return OrderItem::where('product_id', $topProduct->id)
            ->whereHas('order', function ($q) {
                $q->where('status', 'completed')
                    ->whereBetween('created_at', [
                        now()->startOfMonth(),
                        now()->endOfMonth()
                    ]);
            })
            ->sum('quantity');
    }

    private function getRevenueInRange($startDate, $endDate)
    {
        return OrderItem::whereHas('order', function ($q) use ($startDate, $endDate) {
            $q->where('seller_id', $this->sellerId)
                ->where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate]);
        })->sum(DB::raw('price * quantity'));
    }

    public function getMonthlyGrowthPercentage()
    {
        $currentMonth = $this->getRevenueInRange(
            now()->startOfMonth(),
            now()->endOfMonth()
        );

        $lastMonth = $this->getRevenueInRange(
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        );

        return $lastMonth > 0
            ? (($currentMonth - $lastMonth) / $lastMonth) * 100
            : 100;
    }

    public function getAllData()
    {
        return [
            'avgReview' => $this->getAverageReview(),
            'orderTotal' => $this->getTotalOrders(),
            'topProduct' => $this->getTopProduct(),
            'soldThisMonth' => $this->getSoldThisMonth(),
            'percentage' => $this->getMonthlyGrowthPercentage(),
        ];
    }
}