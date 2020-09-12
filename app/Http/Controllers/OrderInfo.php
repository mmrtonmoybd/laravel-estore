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

class OrderInfo extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        //$payment = Payment::where('user_id', Auth::guard()->user()->id)->paginate(config('settings.max_item_per_page'));
        //$order = Payment::orders()->where('user_id', Auth::guard()->user()->id)->get();
        //$payment = new Payment();
        $order = Payment::;
        dd($order);
    }
}