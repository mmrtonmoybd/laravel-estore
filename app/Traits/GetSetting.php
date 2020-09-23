<?php
namespace App\Traits;
use App\Setting;

trait GetSetting {
	public function getvalue($value) {
		return Setting::where('name', $value)->first();
	} 
}