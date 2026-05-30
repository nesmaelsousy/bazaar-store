<?php

namespace App\Http\Controllers\site;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;

class CheckoutController extends Controller
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
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to proceed to checkout');
        }

       $cart = $this->cart;

        return view('frontend.checkout.index', [
            'cart' => $cart->getCart(),
            'total' => $cart->total()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
