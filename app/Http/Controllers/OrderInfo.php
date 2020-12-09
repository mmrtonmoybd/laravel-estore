<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Models\Payment;

use Illuminate\Support\Facades\Auth;
use SEO;

class OrderInfo extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        SEO::setTitle('Payment Information');
        SEO::opengraph()->setUrl(url('/users/orders/'));
        SEO::setCanonical(url('/users/orders/'));
        SEO::opengraph()->addProperty('type', 'orders');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        $payments = Payment::where('user_id', Auth::guard()->user()->id)->latest()->paginate(\App\Models\Setting::getValue('item_per_page'));
        
        return view('auth.payments', [
            'payments' => $payments,
        ]);
    }

    public function orders(Payment $id)
    {
        //dd($id); successfull
        $this->authorize('paymentOrderView', $id);
        SEO::setTitle('Order Information');
        SEO::opengraph()->setUrl(url('/users/orders/'));
        SEO::setCanonical(url('/users/orders/'));
        SEO::opengraph()->addProperty('type', 'orders');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        $orders = $id->orders()->get();
        $product = $id->product()->get();
        
        return view('auth.orders', [
            'payment' => $id,
            'orders' => $orders,
            'products' => $product,
        ]);
    }
}
