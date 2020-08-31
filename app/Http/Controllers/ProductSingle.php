<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Traits\ProductShow;

class ProductSingle extends Controller
{
   use ProductShow;
    public function index(Product $id) {
		if (is_object($this->getRelatedProducts($id->category_id))) {
			$related = true;
		} else {
			$related = false;
		}
     return view('single', [
     'product' => $id,
     'relatedProductsv' => $this->getRelatedProducts($id->category_id),
	 'categories' => $this->getCategories(),
     'discounds' => $this->getDiscoundProducts(),
	 'relatedbool' => $related
     ]);
     //dd($id);
    }
}