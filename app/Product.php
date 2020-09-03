<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [
	'views'
	];

	public function category() {
	   return $this->belongsTo('App\Categorie', 'category_id', 'id');
	}
}