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

class Test extends Controller
{
    public function test() {
      
     //dd($mm);
     $product = Product::where('id', 8)->first();
     $user = Auth::user();
     $user->comment(\App\Comment::class, 'Reply to mmrtonmoy');
    }
}