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

class Test extends Controller
{
    public function test() {
      $get = Product::find(8);
     $mm = $get->comments()->get();
     dd($mm);
    }
}