<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\ProductShow;
use SEO;
use Illuminate\Http\Request;

class Index extends Controller
{
    use ProductShow;

    // All post are index in index method.
    public function index()
    {
        SEO::setTitle(\App\Setting::getValue('home_title'));
        SEO::setDescription(\App\Setting::getValue('home_info'));
        SEO::opengraph()->setUrl(url(''));
        SEO::setCanonical(url(''));
        SEO::opengraph()->addProperty('type', 'page');

        $products = Product::orderBy('id', 'desc')->limit(\App\Setting::getValue('item_per_column'))->get();

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
    public function recent(Request $request)
    {

        SEO::setTitle('Recent Products');
        SEO::opengraph()->setUrl(url('/latest/products'));
        SEO::setCanonical(url('/latest/products'));
        SEO::opengraph()->addProperty('type', 'products');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        $column = 'id';
        $order  = 'desc';
        if ($request->order == 'older') {
            $column = 'id';
            $order = 'asc';
        } elseif ($request->order == 'low') {
            $column = 'price';
            $order = 'asc';
        } elseif ($request->order == 'high') {
            $column = 'price';
            $order = 'desc';
        }
        return view('products.recent', [
            'products' => Product::orderBy('id', 'desc')->paginate(\App\Setting::getValue('item_per_page')),
            'categories' => $this->getCategories(),
        ]);
    }
}
