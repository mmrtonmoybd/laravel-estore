<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Product;
use App\Http\Requests\CartRequest;
use App\Traits\CryptTrait;

class CartController extends Controller
{
	use CryptTrait;
    public function index() {
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
	   // for vat
	   $condition1 = new CartCondition([
	   "name" => "VAT",
	   "type" => "tax",
	   "target" => "total",
	   "value" => "{env('CART_VAT')}%"
	   ]);
	   
		\Cart::add([
		'id' => $product->id,
		'name' => $product->title,
        'price' => $product->price,
        'quantity' => $request->input('quantity'),
		'attributes' => array(
                'image' => $product->image
            ),
            'associatedModel' => 'Product',
            'conditions' => [$condition, $condition1]
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
	
	public function updateProduct(Request $request) {
	   $request->validate([
	   'id' => 'required|numeric|exists:products,id',
	   'quantity' => 'required|numeric|max:5'
	   ]);
		\Cart::update($request->input('id'), [
		'quantity' => [
		'relative' => false,
		'value' => $request->input('quantity')
		],
		]);
		return redirect()->route('cart.index')->with('success', 'Item has been updated!');
	}
	
	public function cartClear() {
		\Cart::clear();
		return redirect()->route('cart.index')->with('success', 'Cart has been cleared!');
	}
}