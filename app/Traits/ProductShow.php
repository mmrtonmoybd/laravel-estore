<?php

namespace App\Traits;

use App\Models\Categorie as Category;
use App\Models\Product as ProductModel;

trait ProductShow
{
    private function getDiscoundProducts()
    {
        return ProductModel::where([
            ['discounds', '>=', 1],
            ['quantity', '>=', 1],
        ])->orderBy('discounds', 'desc')->limit(\App\Setting::getValue('item_per_column'))->get();
    }

    // @param $category_id = product category id
    private function getRelatedProducts(int $category_id, $id = 1)
    {
        //dd($id);
        return ProductModel::where('category_id', $category_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(\App\Setting::getValue('item_per_column'))->get();
    }

    private function getCategories()
    {
        return Category::where('products', '>=', 1)->get();
    }

    private function getMostViewsProduct()
    {
        return ProductModel::popularAllTime()->limit(\App\Setting::getValue('item_per_column'))->get();
    }
}
