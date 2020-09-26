<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\HasComments;

class Product extends Model implements Commentable
{
	use HasComments;
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
	
	public function user(int $id) {
		$find = \App\User::find($id);
		return $find;
	}
	
	public function adminCom(int $id) {
		$find = \App\Admin::find($id);
		return $find;
	}
}