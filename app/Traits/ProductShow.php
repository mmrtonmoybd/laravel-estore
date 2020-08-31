<?php
namespace App\Traits;
use App\Product as ProductModel;

trait ProductShow {
   
   private function getDiscoundProducts() {
       $product = ProductModel::where('discounds', '>=' , 1)->where('quantity', '>=', 1)->get();
       return $product;
    }
    
    private function getRelatedProducts(int $id) {
       
    }
}
?>