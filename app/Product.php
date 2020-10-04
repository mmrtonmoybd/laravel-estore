<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\HasComments;
use willvincent\Rateable\Rateable;
use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;

class Product extends Model implements Commentable
{
	use HasComments, Rateable;
  protected $fillable = ['category_id', 'title', 'price', 'discounds', 'description', 'quantity', 'admin_id', 'image', 'color', 'size'];
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
	
	// markdown affect view
	
	public static function getParse($value)
{
	$environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension);

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => 'escape',
        ], $environment);
    return new HtmlString($converter->convertToHtml($value));
}

public function orderr() {
	return $this->hasMany('App\Order');
}

}