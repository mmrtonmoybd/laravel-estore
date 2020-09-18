<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    
    public function broker()
{
    return Password::broker('admins');
}
    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    protected $redirectTo = RouteServiceProvider::ADMIN;
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset', [
        'token' => $token,
        'email' => $request->email
        ]);
    }
}