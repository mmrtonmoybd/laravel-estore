<?php
namespace App\Traits;
use App\Product as ProductModel;
use App\Categorie as Category;

trait ProductShow {
   
   private function getDiscoundProducts() {
       $product = ProductModel::where([
	   ['discounds', '>=' , 1],
	   ['quantity', '>=', 1],
	   ])->orderBy('discounds', 'desc')->limit(6)->get();
       return $product;
    }
    /*
	@param $category_id = product category id
	*/
    private function getRelatedProducts(int $category_id) {
       $product = ProductModel::where('category_id', $category_id)->orderBy('id', 'desc')->limit(6)->get();
	   return $product;
    }
	
	/*
	private function getProducts(int $limit) {
		$product = ProductModel::orderBy('id', 'desc')->limit($limit)->get();
		return $product;
	}
	*/
	private function getCategories() {
	   return Category::where('products', '>=', 1)->get();
	}
}
?>