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
use Illuminate\Support\Facades\Gate;

class UserProfile extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
    public function index(User $id) {
		//$user = User::find($id->id);
		//$this->authorize('isAuthorize', $id);
        return view('auth.profile', [
        'profile' => $id 
        ]);
    }
}