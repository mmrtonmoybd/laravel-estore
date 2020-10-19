<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rating;

class RatingController extends Controller
{
    public function index()
    {
        return view('admin.rating', [
            'rates' => Rating::latest()->paginate(\App\Setting::getValue('item_per_page')),
        ]);
    }

    public function delete(Rating $id)
    {
        $id->delete();

        return redirect()->route('admin.rating.list')->with('success', 'Rating is deleted!');
    }
}
