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
   public function __construct() {
      $this->middleware(['auth', 'checkout']);
   }
   public $vat;
   
   private function setVat($value) {
       $this->vat = $value;
       return $this->vat;
    }
    
    public function index() {
       // Checkout form with stripe js
       return view('checkout', [
       'total' => $this->getTotalWithVat(Cart::getTotal()),
       'totalvat' => $this->vat
       ]);
    }
    
    // our main method, We need to validate request then Checkout, after checkout store data in Payment table with Payment id. Also store order information in Order table.
    public function checkout(Request $request) {
       $request->validate([
       '_token' => 'required|max:255|string',
       'email' => 'required|email|max:255',
       'address' => 'required|max:450|string',
       'mobile' => 'required|numeric',
       'name' => 'required|string|max:255'
       ]);
       
       $omnipay = Omnipay::create('Stripe');
       $omnipay->setApiKey(config('settings.stripe_secret'));
      $response = $omnipay->purchase([
      'amount' => $this->getTotalWithVat(Cart::getTotal()),
      'currency' => config('settings.stripe_currency'),
      'token' => $request->input('_token')
      ])->send();
      
      if ($response->isRedirect()) {
         return $response->redirect();
      } elseif ($response->isSuccessful()) {
         // Payment is successful
         dd($response->getData());
         /*
         $data = $response->getData();
         $payment_id = $data['id'];
         $payment = Payment::where('payment_id', $payment_id)->first();
         if (is_object($payment)) {
             $payment = new Payment();
             $payment->payment_id = $payment_id;
             $payment->payer_email = $request->input('email');
             $payment->mobile = $request->input('mobile');
             $payment->address = $request->input('address');
             $payment->name = $request->input('name');
             $payment->save();
             $payment = Payment::where('payment_id', $payment_id)->first();
             foreach (Cart::getContent() as $item) {
                 $oder = new order();
                 
             }
         }
         */
      } else {
         
         return redirect()->back()->with('error', $response->getMessage());
      }
      //print_r($request->all());
    }
    
    private function getTotalWithVat($value) {
       $vat = config('settings.vat');
       $calculation = $value * $vat / 100;
       $this->setVat($calculation);
       $calculation = $value + $calculation;
       return $calculation;
    }
}