<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    protected string $guard = 'web';
    protected string $lhome = '/';
    /**
     * Show the confirm password view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        return view('auth.confirm-password');
    }

    /**
     * guard
     *
     **/
    protected function setGuard(string $sguard)
    {
        $this->guard = $sguard;
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    protected function setHome(string $shome)
    {
        $this->lhome = $shome;
    }

     protected function home()
    {
        return $this->lhome;
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! $this->guard()->validate([
            'email' => $request->user($this->guard)->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('Icorrect password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended($this->home());
    }
}
