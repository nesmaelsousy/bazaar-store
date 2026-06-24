<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $cookieId = Cookie::get('cart_id');

        if ($cookieId) {

            $guestItems = Cart::where('cookie_id', $cookieId)->get();

            foreach ($guestItems as $item) {

                $existing = Cart::where('user_id', auth()->id())
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

            Cookie::queue(Cookie::forget('cart_id'));
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();


        $request->session()->regenerateToken();

        return redirect('/');
    }
}
