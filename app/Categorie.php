<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $guarded = [
	'products'
	];
	//public $timestamps = true;
	public function product() {
	   return $this->hasMany('App\Product', 'category_id');
	}
}