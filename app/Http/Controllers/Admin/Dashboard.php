<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Categorie;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Page;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;

class Dashboard extends Controller
{
    public function index()
    {
        $admins = Admin::count();
        $users = User::count();
        $payments = Payment::count();
        $incomes = Payment::sum('amount');
        $products = Product::count();
        $orders = Order::sum('quantity');
        $rating = Rating::sum('rating');
        $category = Categorie::count();
        $page = Page::count();

        return view('admin.index', [
            'admins' => $admins,
            'users' => $users,
            'payments' => $payments,
            'incomes' => $incomes,
            'products' => $products,
            'sells' => $orders,
            'rating' => $rating,
            'category' => $category,
            'pages' => $page,
        ]);
    }
}
