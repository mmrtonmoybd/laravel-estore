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
       $products = Product::orderBy('id', 'desc')->limit(env('MAX_LATEST_PRODUCTS'))->get();
       return view('index', [
       'products' => $products,
       'categories' => $this->getCategories(),
       'discounds' => $this->getDiscoundProducts()
       ]);
    }
    //recent post
    public function recent() {
       return view('products.recent', [
       'products' => Product::orderBy('id', 'desc')->paginate(env('MAX_PRODUCTS_PER_PAGE')),
       'categories' => $this->getCategories()
       ]);
    }
}