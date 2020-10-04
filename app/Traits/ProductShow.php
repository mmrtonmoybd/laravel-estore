<?php
namespace App\Traits;
use App\Product as ProductModel;
use App\Categorie as Category;
use App\Order as OrderModel;

trait ProductShow {
   
   private function getDiscoundProducts() {
       $product = ProductModel::where([
	   ['discounds', '>=' , 1],
	   ['quantity', '>=', 1],
	   ])->orderBy('discounds', 'desc')->limit(config('settings.max_discounded_item'))->get();
       return $product;
    }
    /*
	@param $category_id = product category id
	*/
    private function getRelatedProducts(int $category_id, $id) {
       $product = ProductModel::where('category_id', $category_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(config('settings.max_related_item'))->get();
	   return $product;
    }
	
	private function getCategories() {
	   return Category::where('products', '>=', 1)->get();
	}
	
	private function getMostViewsProduct() {
		return ProductModel::orderBy('views', 'desc')->limit(config('settings.max_related_item'))->get();
	}
	
	private function getMostSellProduct() {
		return OrderModel::select(\DB::raw(' COUNT(`product_id`) AS `product_id`'))->with('product')->groupBy('product_id')->limit(config('settings.max_related_item'))->get();
	}
	
	}
?>