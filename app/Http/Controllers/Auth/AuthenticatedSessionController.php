<?php

namespace App\Http\Controllers\Auth;

use App\Models\cart;
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
        # Merge guest cart into user cart
        cart::where('cookie_id', cart::getCookieId())->update(['user_id' => auth()->id()]);

        return redirect($request->redirect ?? route('frontend.checkout.index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();


        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
