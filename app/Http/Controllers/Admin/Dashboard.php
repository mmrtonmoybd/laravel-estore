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
use App\User;
use App\Admin;
use App\Product;
use App\Payment;
use App\Order;

class Dashboard extends Controller
{
    public function index() {
        $admins = Admin::count();
        $users = User::count();
        $payments = Payment::count();
        $incomes = Payment::sum('amount');
        $products = Product::count();
        $orders = Order::sum('quantity');
        return view('admin.index', [
        'admins' => $admins,
        'users' => $users,
        'payments' => $payments,
        'incomes' => $incomes,
        'products' => $products,
        'sells' => $orders,
        ]);
    }
}