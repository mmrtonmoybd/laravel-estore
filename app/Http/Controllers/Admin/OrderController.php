<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders', [
            'orders' => Order::latest()->paginate(\App\Setting::getValue('item_per_page')),
        ]);
    }

    public function showForm(Order $id)
    {
        return view('admin.orderupdate', [
            'order' => $id,
        ]);
    }

    public function update(Request $request, Order $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $id->status = $request->input('status');
        $id->save();

        return redirect()->route('admin.order.list')->with('success', 'Order is updated');
    }

    public function delete(Order $id)
    {
        $id->delete();

        return redirect()->route('admin.order.list')->with('success', 'Order is deleted');
    }
}
