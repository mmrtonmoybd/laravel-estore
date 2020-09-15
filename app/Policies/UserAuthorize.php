<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAuthorize
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	public function isAuthorize(User $user, User $currentUser) {
        return $user->id === $currentUser->id;
    }
}
