<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Http\Request;

class ResetPasswordController extends NewPasswordController
{
    public function __construct() {
        $this->setBroker('admins');
        $this->setLoginRoute('admin.login');
    }
   
    public function create(Request $request)
    {
        return view('admin.auth.reset',['request' => $request]);
    }
    
}
