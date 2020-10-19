<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payments', [
            'payments' => Payment::latest()->paginate(\App\Setting::getValue('item_per_page')),
        ]);
    }

    public function showForm(Payment $id)
    {
        return view('admin.paymentupdate', [
            'payment' => $id,
        ]);
    }

    public function update(Request $request, Payment $id)
    {
        $request->validate([
            'address' => 'required|string|max:450',
            'mobile' => 'required|numeric',
        ]);
        $id->address = $request->input('address');
        $id->mobile = $request->input('mobile');
        $id->save();

        return redirect()->route('admin.payment.list')->with('success', 'Payment is updated!');
    }

    public function delete(Payment $id)
    {
        $id->delete();

        return redirect()->route('admin.payment.list')->with('success', 'Payment is deleted!');
    }
}
