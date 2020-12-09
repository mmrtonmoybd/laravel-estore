<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings', [
            'title' => Setting::getValue('home_title'),
            'info' => Setting::getValue('home_info'),
            'secret' => Setting::getValue('stripe_secret'),
            'public' => Setting::getValue('stripe_public'),
            'currency' => Setting::getValue('currency'),
            'vat' => Setting::getValue('vat'),
            'item' => Setting::getValue('item_per_page'),
            'column' => Setting::getValue('item_per_column'),
            'currency_icon' => Setting::getValue('currency_icon'),
            'home_img' => Setting::getValue('home_image'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'info' => 'required|string|max:170',
            'item' => 'required|integer|max:22',
            'column' => 'required|integer|max:12',
            'secret' => 'required|string|max:255',
            'public' => 'required|string|max:255',
            'currency' => 'required|string|max:5',
            'currency_icon' => 'required|string|max:1',
            'home_img' => 'image|mimes:jpeg,jpg|max:1024|dimensions:max_width=1200,max_height=630',
        ]);

        Setting::putValue('home_title', $request->input('title'));
        Setting::putValue('home_info', $request->input('info'));
        Setting::putValue('item_per_page', $request->input('item'));
        Setting::putValue('item_per_column', $request->input('column'));
        Setting::putValue('stripe_secret', $request->input('secret'));
        Setting::putValue('stripe_public', $request->input('public'));
        Setting::putValue('currency', $request->input('currency'));
        Setting::putValue('vat', $request->input('vat'));
        Setting::putValue('currency_icon', $request->input('currency_icon'));

        if ($request->hasFile('home_img') && $request->file('home_img')->isValid()) {
            $path = $request->file('home_img')->storeAs(
                'home',
                'home.jpg'
            );

            Setting::putValue('home_image', $path);
        }

        return redirect()->route('admin.setting.list')->with('success', 'Settings is updated!');
    }
}
