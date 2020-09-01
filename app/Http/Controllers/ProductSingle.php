<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Traits\ProductShow;

class ProductSingle extends Controller
{
   use ProductShow;
    public function index(Product $id) {
       /*
     return view('single', [
     'product' => $id,
     'relatedProducts' => $this->getRelatedProducts($id->category_id)
     ]);
     */
     //dd($id);
    }
}