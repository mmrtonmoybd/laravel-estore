<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\AdminInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Admin $id)
    {
        return view('admin.profile', [
            'profile' => $id,
        ]);
    }

    public function showForm(Admin $id)
    {
        //show form for update
        $this->AuthRizeCheck($id);

        return view('admin.profileupdate', [
            'profile' => $id,
        ]);
    }

    public function update(Request $request, Admin $id)
    {
        $this->AuthRizeCheck($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|max:450|string',
            'mobile' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,gif,jpg,bmp|max:1024|dimensions:min_width=100,min_height=50,max_width=450,max_height=480',
            'password' => 'confirmed',
            'facebook' => 'url|required',
        ]);

        $admininfo = AdminInfo::find($id->id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image')->store('avaters');
            $admininfo->image = $image;
        }

        if ($request->has('password') && !empty($request->input('password'))) {
            $id->password = Hash::make($request->input('password'));
        }

        $id->name = $request->input('name');
        $admininfo->address = $request->input('address');
        $admininfo->mobile = $request->input('mobile');
        $admininfo->facebook = $request->input('facebook');
        $admininfo->save();
        $id->save();

        return redirect()->route('admin.profile', ['id' => $id->id])->with('success', 'Your profile is updated!');
    }

    private function AuthRizeCheck(Admin $admin)
    {
        return $this->authorize('adminAuthorize', $admin);
    }
}
