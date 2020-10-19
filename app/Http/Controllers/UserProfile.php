<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SEO;

class UserProfile extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(User $id)
    {
        SEO::setTitle($id->name);
        SEO::opengraph()->setUrl(url("/users/profile/{$id->id}"));
        SEO::setCanonical(url("/users/profile/{$id->id}"));
        SEO::opengraph()->addProperty('type', 'profile');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        SEO::jsonLd()->addImage(asset($id->userInfo->image));
        SEO::opengraph()->addImage(asset($id->userInfo->image));

        return view('auth.profile', [
            'profile' => $id,
            'userinfo' => $id->userInfo()->first(),
        ]);
    }

    public function showInForm(User $id)
    {
        $this->authorize('isAuthorize', $id);
        SEO::setTitle($id->name);
        SEO::opengraph()->setUrl(url("/users/profile/{$id->id}"));
        SEO::setCanonical(url("/users/profile/{$id->id}"));
        SEO::opengraph()->addProperty('type', 'profile');
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        SEO::jsonLd()->addImage(asset($id->userInfo->image));

        return view('auth.profileForm', [
            'profile' => $id,
            'userinfo' => $id->userInfo()->first(),
        ]);
    }

    public function update(Request $request, User $id)
    {
        $this->authorize('isAuthorize', $id);
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|max:450|string',
            'mobile' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,gif,jpg,bmp|max:1024',
            'password' => 'confirmed',
            'facebook' => 'url|required',
        ]);

        $userinfo = UserInfo::find($id->id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image')->store('avaters');
            $userinfo->image = $image;
        }

        if ($request->has('password') && !empty($request->input('password'))) {
            $id->password = Hash::make($request->input('password'));
        }

        $id->name = $request->input('name');
        $userinfo->address = $request->input('address');
        $userinfo->mobile = $request->input('mobile');
        $userinfo->facebook = $request->input('facebook');
        $userinfo->save();
        $id->save();

        return redirect("users/profile/{$id->id}")->with('success', 'Your profile is updated successfully');
        //print_r($request->all());
    }
}
