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
use App\Setting;

class SettingController extends Controller
{
    public function index() {
    	return view('admin.settings', [
    	'title' => Setting::getValue('home_title'),
    	'info' => Setting::getValue('home_info'),
    	'secret' => Setting::getValue('stripe_secret'),
    	'public' => Setting::getValue('stripe_public'),
    	'google' => Setting::getValue('google_key'),
    	'bing' => Setting::getValue('bing_key'),
    	'item' => Setting::getValue('item_per_page'),
    	'column' => Setting::getValue('item_per_column'),
    	'currency' => Setting::getValue('currency'),
    	'vat' => Setting::getValue('vat'),
    	]);
    }
    
    public function update(Request $request) {
    	$request->validate([
    	'title' => 'required|string|max:60',
    	'info' => 'required|string|max:170',
    	'item' => 'required|integer|max:22',
    	'column' => 'required|integer|max:12',
    	'secret' => 'required|string|max:255',
    	'public' => 'required|string|max:255',
    	'google' => 'required|string|max:255',
    	'bing' => 'required|string|max:255',
    	'currency' => 'required|string|max:5',
    	]);
    	
    	Setting::putValue('home_title', $request->input('title'));
    	Setting::putValue('home_info', $request->input('info'));
    	Setting::putValue('item_per_page', $request->input('item'));
    	Setting::putValue('item_per_column', $request->input('column'));
    	Setting::putValue('stripe_secret', $request->input('secret'));
    	Setting::putValue('stripe_public', $request->input('public'));
    	Setting::putValue('google_key', $request->input('google'));
    	Setting::putValue('bing_key', $request->input('bing'));
    	Setting::putValue('currency', $request->input('currency'));
    	Setting::putValue('vat', $request->input('vat'));
    	
    	return redirect()->route('admin.setting.list')->with('success', 'Settings is updated!');
    }
}