<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use App\Order;
use Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function test() {
       $data = [];
       foreach (Cart::getContent() as $item) {
           $ndata = [
         'payment_id' => 1,
         'product_id' => $item->id,
         'quantity' => $item->quantity,
         'user_id' => 1,
         ];
         //print_r($data);
         array_push($data, $ndata);
       }
       dd($data);
    }
}