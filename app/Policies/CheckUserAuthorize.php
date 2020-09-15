<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Policies;

use App\Payment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckUserAuthorize
{
    use HandlesAuthorization;

    

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function paymentOrderView(User $user, Payment $payment)
    {
        return $user->id === $payment->user_id;
    }
    
    public function isAuthorize(User $user, $id) {
        return $user->id === $id; 
    }
}