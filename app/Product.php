<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['category_id', 'title', 'price', 'discounds', 'description', 'quantity', 'admin_id'];
	protected $guarded = [
	'views'
	];

	public function category() {
	   return $this->belongsTo('App\Categorie', 'category_id', 'id');
	}
	
	public static function admin(int $id) {
	   $admin = \App\Admin::find($id);
	   return $admin;
	}
	
	public static function categorya(int $id) {
	   $category = \App\Categorie::find($id);
	   return $category['name'];
	}
	
	public static function order(int $id) {
	    $order = \App\Order::where('product_id', $id)->sum('quantity');
	    return $order;
	}
}