<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   protected function redirectTo($request): ?string
{
    if (! $request->expectsJson()) {

        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        return route('login'); // user login
    }

    return null;
}
}
