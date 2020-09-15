<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfile extends Controller
{
    public function index(User $id) {
        return view('auth.profile', [
        'profile' => $id 
        ]);
    }
}