<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class OptimizeController extends Controller
{
    public function index()
    {
        //re
    }

    public function optimize()
    {
        Artisan::call('optimize');
        Artisan::call('view:cache');
        Artisan::call('event:cache');
    }

    public function clearoptimize()
    {
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
    }
}
