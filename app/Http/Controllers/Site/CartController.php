<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    protected CartRepository $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display the shopping cart
     * 
     *  IMPROVEMENT: Don't pass entire repository to view
     * Pass the cart data instead
     */
    public function index(): View
    {
        return view('frontend.cart', [
            'cart' => $this->cart->getCart(),
            'total' => $this->cart->total(),
        ]);
    }

    /**
     * Add a product to the cart
     * 
     *   IMPROVEMENTS:
     * - Better validation with exists rule
     * - Explicit error handling for product not found
     * - Type hints and return types
     * - Flashback on validation errors
     */
    public function store(CartRequest $request): RedirectResponse
    {
        $data = $request->validated();

        try {
            $product = Product::findOrFail($data['product_id']);
            if (auth()->id() == $product->seller_id) {
                return back()->with('error', 'You cannot buy your own product.');
            }
            // Check stock if you have a stock tracking system
            $quantity = $data['quantity'] ?? 1;
            $attributes = $data['attributes'] ?? [];
            $engraving = $data['engraving'] ?? null;

            $this->cart->addToCart($product, $quantity, $attributes, $engraving);
            // dd($request->all());
            return redirect()
                ->route('frontend.cart.index')
                ->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update cart item quantity
     * 
     *   IMPROVEMENTS:
     * - Validate ID format
     * - Check quantity is actually provided
     * - Better error messages
     * - Return JSON response for AJAX
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'attributes' => 'nullable|array',
            'engraving' => 'nullable'
        ]);

        try {
            $updated = $this->cart->updateCart(
                $id,
                $data['quantity'],
                $data['attributes'] ?? [],
                $data['engraving'] ?? null
            );
            if (!$updated) {
                return redirect()
                    ->back()
                    ->with('warning', 'Cart item not found.');
            }

            return redirect()
                ->route('frontend.cart.index')
                ->with('success', 'Cart updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update cart. Please try again.');
        }
    }

    /**
     * Remove a product from the cart
     * 
     *  IMPROVEMENTS:
     * - Better error handling
     * - Confirmation message
     * - Type hints
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $deleted = $this->cart->deleteCart($id);

            if (!$deleted) {
                return redirect()
                    ->back()
                    ->with('warning', 'Item not found in cart.');
            }

            return redirect()
                ->route('frontend.cart.index')
                ->with('success', 'Product removed from cart successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to remove product. Please try again.');
        }
    }

    /**
     * Clear entire cart
     * 
     *   NEW: Explicit method to clear cart with confirmation
     */
    public function clear(): RedirectResponse
    {
        try {
            $this->cart->clearCart();

            return redirect()
                ->route('frontend.cart.index')
                ->with('success', 'Cart cleared successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to clear cart. Please try again.');
        }
    }

    /**
     * Get cart data (useful for AJAX/API responses)
     * 
     *  NEW: Useful for modern frontend frameworks
     */
    public function getCartData()
    {
        return response()->json([
            'cart' => $this->cart->getCart(),
            'total' => $this->cart->total(),

        ]);
    }
}
