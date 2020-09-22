<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'payment_id', 'product_id', 'quantity', 'user_id'
    ];
    
    public function payment() {
    	return $this->belongsTo('App\Payment');
    }
    
    public function product() {
    	return $this->belongsTo('App\Product');
    }
    
    public function user() {
    	return $this->belongsTo('App\User');
    }
}