<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pid' => 'required|numeric|exists:products,id',
            'star' => 'required|integer|max:5|min:1',
        ]);
        $product = Product::where('id', $request->input('pid'))->first();
        $product->rateOnce($request->input('star'));	//print_r($request->all());

        return redirect("/product/{$request->input('pid')}")->with('rsuccess', 'Rating is added or updated!');
    }
}
