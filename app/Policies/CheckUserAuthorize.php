<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckUserAuthorize
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function paymentOrderView(User $user, Payment $payment)
    {
        return $user->id === $payment->user_id;
    }
}
