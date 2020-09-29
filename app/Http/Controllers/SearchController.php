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
use App\Traits\ProductShow;

class SearchController extends Controller
{
	use ProductShow;
    public function index(Request $request) {
		$request->validate([
		'search' => 'required|string|regex:^[A-Za-z0-9 ]',
		]);
		return view('products.search', [
       'products' => Product::where('title', 'LIKE', '%' . $request->search . '%')->latest()->paginate(config('settings.max_item_per_page')),
       'categories' => $this->getCategories(),
       ]);
	}
}
