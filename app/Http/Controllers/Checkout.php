<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Order;
use Omnipay\Omnipay;
use Cart;

class Checkout extends Controller
{
    public function index() {
       // Checkout form with stripe js
    }
    
    // our main method, We need to validate request then Checkout, after checkout store data in Payment table with Payment id. Also store order information in Order table.
    public function checkout(Request $request) {
       $request->validate([
       'token' => 'required|max:255|string',
       'email' => 'required|email|max:255',
       'address' => 'required|max:450|string',
       'mobile' => 'required|max:15|numeric'
       ]);
       $omnipay = Omnipay::create('Stripe');
       $omnipay->setApiKey(env('STRIPE_SECRET_KEY'));
      $response = $omnipay->purchase([
      'amount' => Cart::getTotal(),
      'currency' => env('STRIPE_CURRENCY'),
      'token' => $request->input('token')
      ])->send();
      
      if ($response->isRedirect()) {
         return $response->redirect();
      } elseif ($response->isSuccessful()) {
         // Payment is successful
         
      } else {
         
         return redirect()->back()->with('error', $response->getMessage());
      }
    }
}