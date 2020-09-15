<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use App\Payment;
//use App\Order

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderInfo extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $payments = Payment::where('user_id', Auth::guard()->user()->id)->latest()->paginate(config('settings.max_item_per_page'));
        //dd($payments); successfull
        return view('auth.payments', [
        'payments' => $payments
        ]);
    }
    
    public function orders(Payment $id) {
        //dd($id); successfull
        $this->authorize('paymentOrderView', $id);
        if (session()->has('success')) {
            \Cart::clear();
        }
        $orders = $id->orders()->get();
        $product = $id->product()->get();
        //dd($order); successfull
        //$product = $id->product(1);
        //dd($product); successfull
        return view('auth.orders', [
        'payment' => $id,
        'orders' => $orders,
        'products' => $product,
        ]);
		//dd($id->product()->get());
        //dd($id->product()->get()); many to many relation is successfull
    }
}