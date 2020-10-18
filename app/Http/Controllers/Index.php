<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\ProductShow;
use SEO;

class Index extends Controller
{
    use ProductShow;

    // All post are index in index method.
    public function index()
    {
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
    public function recent()
    {
        SEO::setTitle('Recent Products');
        SEO::opengraph()->setUrl(url('/latest/products'));
        SEO::setCanonical(url('/latest/products'));
        SEO::opengraph()->addProperty('type', 'products');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        return view('products.recent', [
            'products' => Product::orderBy('id', 'desc')->paginate(config('settings.max_item_per_page')),
            'categories' => $this->getCategories(),
        ]);
    }
}
