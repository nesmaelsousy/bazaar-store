<?php

namespace App\Http\Controllers\site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $repository = app('cart');
        // $items = $cart->getCart();
        return view('frontend.cart', ['cart' => $this->cart]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'nullable|int|min:1'
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        // $repository =  new CartModelRepository();
        $cart->addToCart($product, $request->post('quantity', 1));
        return redirect()->route('frontend.cart.index')->with('success', 'Product added to cart successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart, $id)
    {
        $request->validate([
            'quantity' => 'nullable|int|min:1',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ]);


        $cart->updateCart(
            $id,
            $request->quantity
        );


        return redirect()->route('frontend.cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, string $id)
    {

        $cart->deleteCart($id);
        return redirect()->route('frontend.cart.index')->with('success', 'Product removed from cart successfully!');
    }
}
