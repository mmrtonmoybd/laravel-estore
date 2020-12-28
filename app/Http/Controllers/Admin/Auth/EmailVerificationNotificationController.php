<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->intended('/admins');
        }

        $request->user('admin')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
