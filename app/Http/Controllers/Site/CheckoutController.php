<?php

namespace App\Http\Controllers\Site;

use App\Events\OrderCreated;
use App\Models\cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Throwable;

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
    public function index(CartRepository $cart)
    {
        if (!auth()->check()) {
            session(['url.intended' => route('frontend.checkout.index')]);
            return redirect()->route('login');
        }
        if ($cart->count() == 0) {
            return redirect()->route('frontend.index');
        }

        $cookieId = Cookie::get('cart_id');

        if ($cookieId && auth()->check() && !session('cart_merged')) {
            DB::transaction(function () use ($cookieId) {

                $guestItems = cart::where('cookie_id', $cookieId)->get();

                foreach ($guestItems as $item) {

                    $existing = cart::where('user_id', auth()->id())
                        ->where('product_id', $item->product_id)
                        ->first();

                    if ($existing) {
                        $existing->quantity += $item->quantity;
                        $existing->save();
                        $item->delete();
                    } else {
                        $item->user_id = auth()->id();
                        $item->cookie_id = null;
                        $item->save();
                    }
                }
            });

            Cookie::queue(Cookie::forget('cart_id'));
            session(['cart_merged' => true]);
        }


        $carts = Cart::forCurrentUser()->with('product')->get();

        return view('frontend.checkout.index', compact('carts', 'cart'));
    }



    public function store(CheckoutRequest $request, CartRepository $cart)
    {
        $request->validated();
        $items = $cart->getCart();


        DB::beginTransaction();
        try {
            $groupedBySeller = $items->groupBy(function ($cartItem) {
                return $cartItem->product->seller_id; // خذ من Product!
            });
            
            //    dd($groupedBySeller);
            foreach ($groupedBySeller as $seller_id => $cart_items) {
                $total = $cart_items->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'seller_id' => $seller_id,
                    'total_price' => $total,
                    'payment_method' => 'code',
                    'status'=>'pending',
                    'number' => Order::getNextOrderNumber(),
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->title,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'attributes' => json_encode($item->attributes ?? []),
                        'engraving' => $item->engraving ?? null,
                    ]);
                }
                // بيانات الكلاينت في جدول الاوردر ادرسس
                // dd($request->all());
                $order->address()->create([
                    'fullname' => $request->fullname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'country' => $request->country,
                    'city' => $request->city,
                    'district' => $request->district,
                    'street' => $request->street,
                    'BuildNum' => $request->BuildNum,
                    'floor' => $request->floor,
                    'apartment' => $request->apartment,
                ]);
            }
            $cart->clearCart();
            event(new OrderCreated($items));


            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('frontend.payment.create', $order->id);
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
