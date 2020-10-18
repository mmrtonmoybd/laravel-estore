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
use PDF;

class Invoice extends Controller
{
    private $pdf;

    public function stream(Payment $id)
    {
        $this->genarate($id);

        return $this->pdf->stream();
    }

    public function download(Payment $id)
    {
        $this->genarate($id);

        return $this->pdf->download($id->id);
    }

    private function genarate(Payment $id)
    {
        $orders = $id->orders()->get();
        $product = $id->product()->get();
        $this->pdf = PDF::loadView('admin.invoice', [
            'payment' => $id,
            'orders' => $orders,
            'products' => $product,
        ]);

        return $this->pdf;
    }
}
