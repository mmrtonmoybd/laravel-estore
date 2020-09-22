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
use App\Product;
use App\Categorie;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        return view('admin.products', [
        'products' => Product::orderBy('id', 'desc')->paginate(config('settings.max_item_per_page')),
        ]);
    }
	
	public function add() {
		return view('admin.productadd', [
		'categorys' => Categorie::get(),
		]);
	}
	
	public function store(Request $request) {
	    $request->validate([
	    'title' => 'required|string|max:255',
	    'quantity' => 'required|integer|min:1',
	    'category' => 'required|integer|exists:categories,id',
	    'info' => 'required|string',
	    'thumbnail' => 'required|image|mimes:jpeg,png,gif,jpg,svg|max:4096|dimensions:min_width=400,min_height=200,max_width=2500,max_height=2500',
	    'discounds' => 'required|integer|max:100',
	    'price' => 'required|numeric',
	    ]);
	    
	    if (!$request->file('thumbnail')->isValid()) {
          
          return redirect()->back()->with(['errors' => 'Thumbnail is not valid.']);
      }
   
      $thumbnail = $request->file('thumbnail')->store('products');
      Product::create([
      'title' => $request->input('title'),
      'category_id' => $request->input('category'),
      'price' => $request->input('price'),
      'discounds' => $request->input('discounds'),
      'description' => $request->input('info'),
      'quantity' => $request->input('quantity'),
      'image' => $thumbnail,
      'admin_id' => $request->user()->id,
      ]);
      
      $category = Categorie::find($request->input('category'));
      $category->products++;
      $category->save();
      return redirect()->route('admin.product.list')->with('success', 'Product adding is successfull!');
	}
	
	public function showForm(Product $id) {
	    return view('admin.productedit', [
	    'product' => $id,
	    'categorys' => Categorie::get(),
	    ]);
	}
	
	public function update(Request $request, Product $id) {
	    $request->validate([
	    'title' => 'required|string|max:255',
	    'quantity' => 'required|integer|min:1',
	    'category' => 'required|integer|exists:categories,id',
	    'info' => 'required|string',
	    'thumbnail' => 'image|mimes:jpeg,png,gif,jpg,svg|max:4096|dimensions:min_width=400,min_height=200,max_width=2500,max_height=2500',
	    'discounds' => 'required|integer|max:100',
	    'price' => 'required|numeric',
	    ]);
	    
		if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
          $thumbnail = $request->file('thumbnail')->store('products');
          $id->image = $thumbnail;
      }
	  
	    $id->title = $request->input('title');
	    $id->quantity = $request->input('quantity');
	    $id->category_id = $request->input('category');
	    $id->description = $request->input('info');
	    $id->discounds = $request->input('discounds');
		$id->price = $request->input('price');
		$id->save();
		
	    return redirect()->route('admin.product.list')->with('success', 'Product updated is successfull!');
	}
	
	public function delete(Product $id) {
	    $id->delete();
	    return redirect()->route('admin.product.list')->with('success', 'Product deleted is successfull!');
	}
}