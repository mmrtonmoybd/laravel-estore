<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Setting;

class Test extends Controller
{
    public function test() {
      $get = Setting::where('name', 'app_name')->first();
		return $get->value;
    }
}