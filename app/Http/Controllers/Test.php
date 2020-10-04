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
use App\Traits\ProductShow;

class Test extends Controller
{ 
use ProductShow;
	
    public function test() {
    	dd($this->getMostSellProduct());
    }
}