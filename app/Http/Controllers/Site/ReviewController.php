<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        try {

            $hasBought = Order::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->whereHas('orderItems', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })->exists();

            if (!$hasBought) {
                return back()->with('error', 'You cannot review without purchasing the product.');
            }
            $alreadyReviewed  = ProductReview::where('product_id', $product->id)
                ->where('user_id', auth()->id())->exists();
            if ($alreadyReviewed) {
                return back()->with('error', 'You already reviewed this product.');
            }
            if (auth()->id() == $product->seller_id) {
                return back()->with('error', 'You cannot review your own product.');
            }

            ProductReview::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'user_id' => auth()->id()
                ],
                [
                    'rating' => $request->rating,
                    'comment' => $request->comment
                ]
            );

            return back()->with('success', 'Rating added');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
