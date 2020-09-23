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

class GetSetting extends Controller
{
    public static function getValue($name) {
		$get = Setting::where('name', $name)->first();
		return $get->value;
	}
}
