<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Traits\CryptTrait;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Setting extends Model
{
	//use CryptTrait;
    protected $fillable = ['name', 'value'];
	
	public function setValueAttribute($value) {
		$this->attributes['value'] = Crypt::encryptString($value);
	}
	
	public function getValueAttribute($value) {
		try {
	      return Crypt::decryptString($value);
	   } catch (DecryptException $e) {
	      echo "Unable to decrypt this hash: ";
	   }
	}
	
	public static function getValue($name) {
		$get = Setting::where('name', $name)->first();
		return $get->value;
	}
	
	public static function putValue($name, $putval) {
		
		$getId = Setting::where('name', $name)->first();
		$find = Setting::find($getId->id);
	  $find->value = $putval;
	  return $find->save();
	}
}