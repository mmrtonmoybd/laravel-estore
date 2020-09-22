<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserInfo;

class UserController extends Controller
{
    public function index() {
		return view('admin.users', [
		'users' => User::paginate(config('settings.max_item_per_page')),
		]);
	}
	
	public function showForm(User $id) {
		return view('admin.userupdate', [
		'user' => $id,
		]);
	}
	
	public function update(Request $request, User $id) {
		$request->validate([
		'name' => 'required|string',
		'email' => 'required|email|max:255',
		'address' => 'required|string',
		'mobile' => 'required|numeric',
		'facebook' => 'required|url',
		'password' => 'confirmed',
		]);
		$id->name = $request->input('name');
		$id->email = $request->input('email');
		$id->userInfo->address = $request->input('address');
		$id->userInfo->
		if (!empty($request->input('password'))) {
			$id->password = Password::make($request->input('password'));
		}
		$id->save();
		$info = UserInfo::find($id->id);
		$info->mobile = $request->input('mobile');
		$info->facebook = $request->input('facebook');
		$info->save();
		return redirect()->route('admin.user.list')->with('success', 'User is updated');
	}
	
	public function delete(User $id) {
		$id->delete();
		return redirect()->route('admin.user.list')->with('success', 'User is deleted');
	}
}