<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest as AuthEmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class EmailVerificationRequest extends AuthEmailVerificationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! hash_equals((string) $this->route('id'),
                          (string) $this->user('admin')->getAuthIdentifier())) {
            return false;
        }

        if (! hash_equals((string) $this->route('hash'),
                          sha1($this->user('admin')->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    public function fulfill()
    {
        if (! $this->user('admin')->hasVerifiedEmail()) {
            $this->user('admin')->markEmailAsVerified();

            event(new Verified($this->user('admin')));
        }
    }

}
