<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class Index extends Controller
{
   /*
   All post are index in index method.
   */
    public function index() {
       $product = Product::all();
       dd($product);
    }
    
    
}