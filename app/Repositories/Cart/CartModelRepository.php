<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartModelRepository implements CartRepository
{
    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }
    public function getCart(): Collection
    {
        return Cart::forCurrentUser()
            ->with('product')
            ->get();
    }
    // add to cart or increment if exists 
    public function addToCart(Product $product, $quantity = 1, $attributes = [], $engraving = null): Cart
    {
        $cartItem = Cart::forCurrentUser()
            ->where('product_id', $product->id)
            ->where('attributes', json_encode($attributes))
            ->where('engraving', $engraving)
            ->first();
        $currentQty = $cartItem ? $cartItem->quantity : 0;
        if ($currentQty + $quantity > $product->stock_quantity) {
            throw new \Exception('Cannot add more than available stock. Remaining: ' .
                ($product->stock_quantity - $currentQty));
        }
        // لو ما فيش عنصر في الكارت بنفس المنتج نضيفه، لو موجود نزيد الكمية
        if (!$cartItem) {
            // Create new cart item
            $cartItem = Cart::create([
                'cookie_id' => Auth::check() ? null : Cart::getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'attributes' => $attributes,
                'engraving' => $engraving,
                'quantity' => $quantity
            ]);
        } else {
            // Increment existing item
            $cartItem->increment('quantity', $quantity);
            $cartItem->refresh();
        }

        return $cartItem;
    }

    public function updateCart($id, $quantity = 1, $attributes = [], $engraving = null)
    {
        DB::beginTransaction();
        try {
            $quantity = max(1, (int) $quantity);
            // 1 عشان ما ينزلش عن max نستخدم   
            $cartItem = Cart::forCurrentUser()
                ->where('id', $id)
                ->first();
            $product = $cartItem->product;
            if ($quantity > $product->stock_quantity) {
                throw new \Exception(
                    "Cannot add more than available stock. Remaining: {$product->stock_quantity}"
                );
            }
            $updateData = ['quantity' => $quantity];
            if (!empty($attributes)) {
                $updateData['attributes'] = $attributes;
            }
            if ($engraving !== null) {
                $updateData['engraving'] = $engraving;
            }
            $cartItem->update($updateData);
            $cartItem->refresh();
            DB::commit();
            return $cartItem;
        } catch (\Exception $e) {
            DB::rollBack();
         
             throw $e;
        }
    }
    public function deleteCart($id)
    {
        return Cart::forCurrentUser()
            ->where('id', $id)
            ->delete();
    }
    public function clearCart()
    {
        return Cart::forCurrentUser()->delete();
    }

    public function total(): float
    {
        return (float) Cart::forCurrentUser()
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->sum(DB::raw('products.price * carts.quantity'));
    }
    /**
     * Get count of items in cart
     */
    public function count(): int
    {
        return Cart::forCurrentUser()
            ->sum('quantity');
    }
}
