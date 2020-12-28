<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string              $guards
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && $guard == 'admin') {
            return redirect(RouteServiceProvider::ADMIN);
        }

        if (Auth::guard()->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        }

        return $next($request);
    }
}
