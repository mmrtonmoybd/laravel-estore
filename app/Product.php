<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['category_id', 'title', 'price', 'discounds', 'description', 'quantity', 'admin_id', 'image'];
	protected $guarded = [
	'views'
	];

	public function category() {
	   return $this->belongsTo('App\Categorie', 'category_id', 'id');
	}
	
	public function admin() {
	   return $this->belongsTo('App\Admin');
	}

	public static function order(int $id) {
	    $order = \App\Order::where('product_id', $id)->sum('quantity');
	    return $order;
	}
	
	/*
	public function order() {
	    return $this->hasMany('App\Order');
	}
	*/
}