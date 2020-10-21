<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Traits\ProductShow;
use Illuminate\Http\Request;
use SEO;

class CategoryProducts extends Controller
{
    use ProductShow;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Categorie $id)
    {
        SEO::setTitle($id->name);
        SEO::setDescription(substr($id->description, 0, 170));
        SEO::opengraph()->setUrl(url("/category/{$id->id}"));
        SEO::setCanonical(url("/category/{$id->id}"));
        SEO::opengraph()->addProperty('type', 'products');
        //SEOTools::twitter()->setSite('@LuizVinicius73');

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

        return view('products.category', [
            'products' => $id->product()->orderBy($column, $order)->paginate(\App\Setting::getValue('item_per_page')),
            'category' => $id,
            'categories' => $this->getCategories(),
        ]);
        //echo env('MAX_PRODUCTS_PER_PAGE');
         //dd($id->product()->get());
    }
}
