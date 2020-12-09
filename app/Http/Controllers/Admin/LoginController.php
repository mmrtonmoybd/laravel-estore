<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Models\AdminInfo;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function authenticated(Request $request, $user)
    {
        Auth::logoutOtherDevices($request->input('password'));
        //dd($request->ip());
        $admin = AdminInfo::find(Auth::guard('admin')->user()->id);
        $admin->ip = !empty($request->ip()) ? $request->ip() : '127.0.0.1';
        $admin->save();
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
