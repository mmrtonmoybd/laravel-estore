<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    'payment_id', 'address', 'mobile', 'name', 'user_id', 'payer_email', 'amount'
    ];
    
    public function orders() {
        return $this->hasMany('App\Order');
    }
    
    
    public function product() {
        return $this->belongsToMany(Product::class, 'orders', 'payment_id', 'product_id');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}