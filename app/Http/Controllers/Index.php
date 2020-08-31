<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Traits\ProductShow;

class Index extends Controller
{
	use ProductShow;
   /*
   All post are index in index method.
   */
    public function index() {
       return view('index');
    }
}