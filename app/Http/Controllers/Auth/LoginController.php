<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\UserInfo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use SEO;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        SEO::setTitle('User Login');
        SEO::opengraph()->setUrl(route('login'));
        SEO::setCanonical(route('login'));
        SEO::opengraph()->addProperty('type', 'page');
    }

    protected function authenticated($request, $user)
    {
        Auth::logoutOtherDevices($request->input('password'));
        $info = UserInfo::find($request->user()->id);
        $info->ip = !empty($request->ip()) ? $request->ip() : '127.0.0.1';
        $info->save();
    }
}
