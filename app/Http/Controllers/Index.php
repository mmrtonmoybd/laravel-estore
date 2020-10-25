<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Product;
use App\Traits\ProductShow;
use Illuminate\Http\Request;
use SEO;

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
        SEO::setTitle('All Products');
        SEO::opengraph()->setUrl(url('/all/products'));
        SEO::setCanonical(url('/all/products'));
        SEO::opengraph()->addProperty('type', 'products');
        $column = 'id';
        $order = 'desc';
        if ('older' == $request->order) {
            $column = 'id';
            $order = 'asc';
        } elseif ('low' == $request->order) {
            $column = 'price';
            $order = 'asc';
        } elseif ('high' == $request->order) {
            $column = 'price';
            $order = 'desc';
        }

        return view('products.recent', [
            'products' => Product::orderBy($column, $order)->paginate(\App\Setting::getValue('item_per_page')),
            'categories' => $this->getCategories(),
        ]);
    }
}
