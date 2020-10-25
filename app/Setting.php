<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App;

use Illuminate\Contracts\Encryption\DecryptException;
//use App\Traits\CryptTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    //use CryptTrait;
    protected $fillable = ['name', 'value'];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = Crypt::encryptString($value);
    }

    public function getValueAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            echo 'Unable to decrypt this hash: ';
        }
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($instance) {
            // update cache content
            Cache::put('setting.'.$instance->name, $instance);
        });

        static::deleting(function ($instance) {
            // delete post cache
            Cache::forget('name.'.$instance->name);
        });
    }

    public static function getValue($name)
    {
        if (!Cache::has('setting.'.$name)) {
            $get = Setting::where('name', $name)->first();
            Cache::put('setting.'.$name, $get);
        } else {
            $get = Cache::get('setting.'.$name);
        }

        return $get->value;
    }

    public static function putValue($name, $putval)
    {
        $getId = Setting::where('name', $name)->first();
        $find = Setting::find($getId->id);
        $find->value = $putval;

        return $find->save();
    }
}
