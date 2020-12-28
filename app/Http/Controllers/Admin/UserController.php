<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'order' => 'string|regex:/[A-Za-z0-9 ]$/i',
        ]);
        $column = 'id';
        $order = 'desc';
        if ('older' == $request->order) {
            $column = 'id';
            $order = 'asc';
        }

        return view('admin.users', [
            'users' => User::orderBy($column, $order)->paginate(\App\Models\Setting::getValue('item_per_page')),
        ]);
    }

    public function addForm()
    {
        return view('admin.useradd');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'mobile' => 'required|numeric',
            'password' => 'required|confirmed|min:7|string',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        UserInfo::create([
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user->id,
            'ip' => '127.0.0.1',
        ]);

        event(new Registered($user));

        return redirect()->route('admin.user.list')->with('success', 'User is created!');
    }

    public function showForm(User $id)
    {
        return view('admin.userupdate', [
            'user' => $id,
        ]);
    }

    public function update(Request $request, User $id)
    {
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
        if (!empty($request->input('password'))) {
            $id->password = Hash::make($request->input('password'));
        }
        $id->save();
        $info = UserInfo::find($id->id);
        $info->mobile = $request->input('mobile');
        $info->address = $request->input('address');
        $info->facebook = $request->input('facebook');
        $info->save();

        return redirect()->route('admin.user.list')->with('success', 'User is updated!');
    }

    public function delete(User $id)
    {
        $id->delete();

        return redirect()->route('admin.user.list')->with('success', 'User is deleted!');
    }
}
