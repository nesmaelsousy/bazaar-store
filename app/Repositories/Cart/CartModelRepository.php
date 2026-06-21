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
        DB::beginTransaction();

        try {
            $quantity = max(1, (int) $quantity);

            // نحسب مفتاح ثابت للـ attributes
            $attributesHash = md5(json_encode($attributes));

            // نجيب كل نفس المنتج بالكارت ونفلتر بالـ hash
            $cartItem = Cart::forCurrentUser()
                ->where('product_id', $product->id)
                ->get()
                ->first(function ($item) use ($attributesHash, $engraving) {
                    return md5(json_encode($item->attributes)) === $attributesHash
                        && $item->engraving === $engraving;
                });

            $currentQty = $cartItem ? $cartItem->quantity : 0;

            // check stock
            if ($currentQty + $quantity > $product->stock_quantity) {
                throw new \Exception(
                    "Cannot add more than available stock. Remaining: " .
                        ($product->stock_quantity - $currentQty)
                );
            }

            // إذا موجود → update quantity
            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
                $cartItem->refresh();
            } else {
                // إنشاء عنصر جديد
                $cartItem = Cart::create([
                    'cookie_id' => Auth::check() ? null : Cart::getCookieId(),
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'attributes' => $attributes,
                    'engraving' => $engraving,
                    'quantity' => $quantity,
                ]);
            }

            DB::commit();
            return $cartItem;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
