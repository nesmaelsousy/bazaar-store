<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cookie_id = request()->cookie('cart_id');

        $cart = \App\Models\Cart::with('product')
            ->where('cookie_id', $cookie_id)
            ->get()
            ->map(function ($cartItem) {
                return [
                    'id' => $cartItem->id,
                    'cookie_id' => $cartItem->cookie_id,
                    'user_id' => $cartItem->user_id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'color' => $cartItem->color,
                    'size' => $cartItem->size,
                    'engraving' => $cartItem->engraving,
                    'product' => [
                        'id' => $cartItem->product->id,
                        'name' => $cartItem->product->name,
                        'price' => $cartItem->product->price,
                        'image' => $cartItem->product->image,
                        'colors' => $cartItem->product->colors,
                        'sizes' => $cartItem->product->sizes,
                    ],
                ];
            });

        return response()->json($cart);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'engraving' => 'nullable|string|max:255',
        ]);

        $cookie_id = $request->cookie('cart_id') ?? \Illuminate\Support\Str::uuid();

        // Check if item already exists in cart
        $cartItem = \App\Models\Cart::where('cookie_id', $cookie_id)
            ->where('product_id', $request->product_id)
            ->where('color', $request->color)
            ->where('size', $request->size)
            ->where('engraving', $request->engraving)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = \App\Models\Cart::create([
                'cookie_id' => $cookie_id,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'color' => $request->color,
                'size' => $request->size,
                'engraving' => $request->engraving,
            ]);
        }

        // Set cookie
        $cookie = \Illuminate\Support\Facades\Cookie::make('cart_id', $cookie_id, 60 * 24 * 30);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart_item' => $cartItem,
            'cart_count' => \App\Models\Cart::where('cookie_id', $cookie_id)->sum('quantity')
        ])->withCookie($cookie);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'engraving' => 'nullable|string|max:255',
        ]);

        $cookie_id = $request->cookie('cart_id');

        $cartItem = \App\Models\Cart::where('id', $id)
            ->where('cookie_id', $cookie_id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->color = $request->color ?? $cartItem->color;
        $cartItem->size = $request->size ?? $cartItem->size;
        $cartItem->engraving = $request->engraving ?? $cartItem->engraving;
        $cartItem->save();

        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart_item' => $cartItem,
            'cart_count' => \App\Models\Cart::where('cookie_id', $cookie_id)->sum('quantity')
        ]);
    }

    public function destroy($id)
    {
        $cookie_id = request()->cookie('cart_id');

        $cartItem = \App\Models\Cart::where('id', $id)
            ->where('cookie_id', $cookie_id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Cart item deleted successfully',
            'cart_count' => \App\Models\Cart::where('cookie_id', $cookie_id)->sum('quantity')
        ]);
    }

    public function clear()
    {
        $cookie_id = request()->cookie('cart_id');

        \App\Models\Cart::where('cookie_id', $cookie_id)->delete();

        return response()->json([
            'message' => 'Cart cleared successfully'
        ]);
    }
}
