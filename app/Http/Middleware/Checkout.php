<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Middleware;

use Closure;
use Cart;

class Checkout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Cart::getTotalQuantity() < 1 ) {
            return redirect()->route('cart.index')->with('alert', 'You did not have any cart content or cart Qty is smaller than 1.');
        }
        return $next($request);
    }
}