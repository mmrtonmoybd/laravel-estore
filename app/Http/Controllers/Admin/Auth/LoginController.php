<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\AdminInfo;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends AuthenticatedSessionController
{
    public function __construct() {
        $this->lhome = '/admins/';
        $this->logred = '/admins/login';
        $this->setGuard('admin');
    }

    public function create()
    {
        return view('admin.auth.login');
    }

    public function afterLogin(LoginRequest $request)
    {
        $admin = AdminInfo::find(Auth::guard('admin')->user()->id);
        $admin->ip = !empty($request->ip()) ? $request->ip() : '127.0.0.1';
        $admin->save();
    }
}
