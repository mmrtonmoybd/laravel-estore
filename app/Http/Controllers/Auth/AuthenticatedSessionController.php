<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\AuthTrait;
use App\Models\UserInfo;

class AuthenticatedSessionController extends Controller
{
    use AuthTrait;
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    protected function afterLogin(LoginRequest $request)
    {
        $info = UserInfo::find($request->user()->id);
        $info->ip = !empty($request->ip()) ? $request->ip() : '127.0.0.1';
        $info->save();
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate($this->guard);
        $this->guard()->logoutOtherDevices($request->input('password'));
        $this->afterLogin($request);
        $request->session()->regenerate();

        return redirect($this->lhome);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($this->logred);
    }
}
