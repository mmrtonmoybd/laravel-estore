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
       $products = Product::orderBy('id', 'desc')->limit(8)->get();
       return view('index', [
       'products' => $products,
       'categories' => $this->getCategories(),
       'discounds' => $this->getDiscoundProducts()
       ]);
    }
}