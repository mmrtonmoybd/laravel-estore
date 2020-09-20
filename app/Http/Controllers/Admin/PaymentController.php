<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    public function index() {
        return view('admin.payments', [
        'payments' => Payment::latest()->paginate(config('settings.max_item_per_page')),
        ]);
    }
    
    public function showForm(Payment $id) {
        return view('admin.paymentupdate', [
        'payment' => $id,
        ]);
    }
}