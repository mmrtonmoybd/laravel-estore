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
use App\Payment;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function test() {
       $payment = Payment::where('payment_id', 'ch_1HQGlFJx9OFS63pgtxdNMANu')->first();
       echo $payment->id;
    }
}