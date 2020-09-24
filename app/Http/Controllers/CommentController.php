<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
    public function store(Request $request) {
    	$request->validate([
    	'id' => 'required|integer|exists:products,id',
    	'comment' => 'required|string',
    	]);
    	
    $product = Product::find($request->input('id'));
    //$product = Product::where('id', )
    	$user = Auth::user();
    	$user->comment($product, $request->input('comment'));
   // 	return redirect("/product/{$request->input('id')}")->with('success', 'Comment is successfull');
    }
}