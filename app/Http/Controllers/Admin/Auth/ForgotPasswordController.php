<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\PasswordResetLinkController;

class ForgotPasswordController extends PasswordResetLinkController
{
    public function __construct() {
        $this->setBroker('admins');
    }

    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.email');
    }
}
