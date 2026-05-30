<?php

namespace App\Repositories\Cart;

use App\Models\cart;
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
        if ($this->items->isEmpty()) {
            $this->items = cart::with('product')->get();
        }
        return $this->items;
    }
    public function addToCart(Product $product, $quantity = 1)
    {
        $cartItem = cart::where('product_id', $product->id)->first();
        if (!$cartItem) {
            $cartItem = cart::create([
                'cookie_id' => cart::getCookieId(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $this->items->push($cartItem);
            return $cartItem;
        }
        // dd($cartItem);
        $cartItem->increment('quantity', $quantity);
        return $cartItem;
    }

    public function updateCart($id, $quantity = 1)
    {
        return  cart::where('id', $id)
            ->update(
                [
                    'quantity' => max(1, $quantity),
                ]
            );
    }
    public function deleteCart($id)
    {
        return cart::where('id', $id)->delete();
    }
    public function clearCart()
    {
        cart::delete();
    }

    public function total(): float
    {
        // return (float) cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->sum(DB::raw('products.price * carts.quantity'));
        return $this->getCart()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
