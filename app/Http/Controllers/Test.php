<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Cart;

class Test extends Controller
{
    public function test() {
    	$arr = [];
      foreach (Cart::getContent() as $cart) {
      	//dd($cart);
      	$arr[] = $cart->id;
      }
      if (in_array(8, $arr)) {
      	echo "not adding this item, item already add in cart.";
      }
    }
}