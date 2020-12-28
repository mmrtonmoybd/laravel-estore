<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\ConfirmablePasswordController as AuthConfirmablePasswordController;
use Illuminate\Http\Request;

class ConfirmablePasswordController extends AuthConfirmablePasswordController
{
    public function __construct() {
        $this->setGuard('admin');
        $this->setHome('/admins');
    }

    public function show(Request $request)
    {
        return view('admin.auth.lock');
    }
}
