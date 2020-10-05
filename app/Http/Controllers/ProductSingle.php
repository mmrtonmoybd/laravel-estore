<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Traits\ProductShow;
use SEO;

class ProductSingle extends Controller
{
   use ProductShow;
    public function index(Product $id) {
    	SEO::setTitle($id->title);
        SEO::setDescription(substr($id->description, 0, 170));
        SEO::opengraph()->setUrl(url("/product/{$id->id}"));
        SEO::setCanonical(url("/product/{$id->id}"));
        SEO::opengraph()->addProperty('type', 'articles');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        SEO::jsonLd()->addImage(asset("products/{$id->image}"));

		if (is_object($this->getRelatedProducts($id->category_id, $id->id))) {
			$related = true;
		} else {
			$related = false;
		}
        $id->visit();		
		$id->save();
     return view('single', [
     'product' => $id,
     'relatedProductsv' => $this->getRelatedProducts($id->category_id),
	 'categories' => $this->getCategories(),
     'discounds' => $this->getDiscoundProducts(),
	 'relatedbool' => $related,
	 'comments' => $id->comments()->get(),
     ]);
     //dd($id);
    }
}