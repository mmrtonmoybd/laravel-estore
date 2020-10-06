<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use App\Product;
use App\Http\Requests\CartRequest;
use SEO;

class CartController extends Controller
{
    public function index() {
    	SEO::setTitle("Cart Items");
        SEO::opengraph()->setUrl(url("/cart/"));
        SEO::setCanonical(url("/cart/"));
        SEO::opengraph()->addProperty('type', 'page');
		return view('carts.cart', [
		'cartCollection' => \Cart::getContent()
		]);
	}
	
	public function addProduct(CartRequest $request) {
		
	   $request->validated();
	   
	   $product = Product::find($request->input('id'));
	   
	   $condition = new CartCondition([
	   "name" => "Discounds Offer",
	   "type" => "discound",
	   "value" => "-{$product->discounds}%"
	   ]);
	   
		\Cart::add([
		'id' => $product->id,
		'name' => $product->title,
        'price' => $product->price,
        'quantity' => $request->input('quantity'),
		'attributes' => [
                'image' => $product->image,
                'color' => $request->input('color'),
                'size' => $request->input('size'),
            ],
            'associatedModel' => $product,
            'conditions' => $condition
		]);
		return redirect()->route('cart.index')->with('success', 'Item is Added to Cart!');
	}
	
	public function removeProduct(Request $request) {
	   $request->validate([
	   'id' => 'required|numeric|exists:products,id'
	   ]);
		\Cart::remove($request->input('id'));
		return redirect()->route('cart.index')->with('success', 'Item has been removed!');
	}
	
	public function updateProduct(CartRequest $request) {
	   $request->validated();
	   
	   SEO::setTitle("Cart Update");
        SEO::opengraph()->setUrl(url("/cart/update/"));
        SEO::setCanonical(url("/cart/update/"));
        SEO::opengraph()->addProperty('type', 'page');
		\Cart::update($request->input('id'), [
		'quantity' => [
		'relative' => false,
		'value' => $request->input('quantity')
		],
		'attributes' => [
		'color' => $request->input('color'),
                'size' => $request->input('size'),
		]
		]);
		return redirect()->route('cart.index')->with('success', 'Item has been updated!');
	}
	
	public function cartClear() {
		\Cart::clear();
		return redirect()->route('cart.index')->with('success', 'Cart has been cleared!');
	}
}