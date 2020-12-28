<?php

namespace App\Traits;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    private string $guard = 'web';
    public string $lhome = RouteServiceProvider::HOME;
    public string $logred = '/';

    public function setGuard(string $sguard = 'web')
    {
        $this->guard = $sguard;
    }

    public function guard()
    {
        return Auth::guard($this->guard);
    }
}
