<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use App\Traits\ProductShow;

class CategoryProducts extends Controller
{
   use ProductShow;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Categorie $id)
    {
        return view('products.category', [
        'products' => $id->product()->orderBy('id', 'desc')->paginate(config('settings.max_item_per_page')),
        'category' => $id,
        'categories' => $this->getCategories()
        ]);
        //echo env('MAX_PRODUCTS_PER_PAGE');
         //dd($id->product()->get());
    }
}