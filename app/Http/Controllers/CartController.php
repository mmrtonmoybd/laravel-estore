<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
		return view('cart.index', [
		'cartCollection' => \Cart::getContent()
		]);
	}
	public function addProduct(Request $request) {
		\Cart::add([
		'id' => $request->input('id'),
		'name' => $request->input('name'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity'),
		'attributes' => array(
                'image' => $request->input('img')
            )
		]);
		return redirect()->route('cart.index')->with('success', 'Item is Added to Cart!');
	}
	
	public function removeProduct(Request $request) {
		\Cart::remove($request>input('id'));
		return redirect()->route('cart.index')->with('success', 'Item has been removed!');
	}
	
	public function updateProduct(Request $request) {
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
