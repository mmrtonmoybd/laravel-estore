<?php

namespace App\Traits;

use App\Categorie as Category;
use App\Product as ProductModel;

trait ProductShow
{
    private function getDiscoundProducts()
    {
        return ProductModel::where([
            ['discounds', '>=', 1],
            ['quantity', '>=', 1],
        ])->orderBy('discounds', 'desc')->limit(config('settings.max_discounded_item'))->get();
    }

    // @param $category_id = product category id
    private function getRelatedProducts(int $category_id, $id = 1)
    {
        //dd($id);
        return ProductModel::where('category_id', $category_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(config('settings.max_related_item'))->get();
    }

    private function getCategories()
    {
        return Category::where('products', '>=', 1)->get();
    }

    private function getMostViewsProduct()
    {
        return ProductModel::popularAllTime()->limit(config('settings.max_related_item'))->get();
    }
}
