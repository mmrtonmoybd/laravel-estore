<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vauchar extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'type', 'code', 'quantity', 'used', 'vaule', 'title', 'vtype'
    ];

    protected $type = ['product', 'user'];

    protected $vtype = ['percent', 'money'];
}
