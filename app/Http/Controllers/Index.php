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
       $products = Product::orderBy('id', 'desc')->limit(config('settings.max_latest_item'))->get();
       return view('index', [
       'products' => $products,
       'categories' => $this->getCategories(),
       'discounds' => $this->getDiscoundProducts(),
       'views' => $this->getMostViewsProduct(),
	   'viewbool' => (is_object($this->getMostViewsProduct())) ? true : false,
	   'disbool' => (is_object($this->getDiscoundProducts())) ? true : false,
	   'catebool' => (is_object($this->getCategories())) ? true : false,
       ]);
    }
    //recent post
    public function recent() {
       return view('products.recent', [
       'products' => Product::orderBy('id', 'desc')->paginate(config('settings.max_item_per_page')),
       'categories' => $this->getCategories()
       ]);
    }
}