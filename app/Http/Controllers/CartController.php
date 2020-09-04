<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Product;

class CartController extends Controller
{
    public function index() {
		return view('carts.cart', [
		'cartCollection' => \Cart::getContent()
		]);
	}
	
	protected function prepareForValidation() {
	   try {
	      $this->merge([
	   'id' => Crypt::decryptString($this->id),
	   ]);
	   } catch (DecryptException $e) {
	      echo "Encryption is not decrypt this hash: " . $e;
	   }
	}
	
	public function addProduct(Request $request) {
	   /*
	   try {
	   $id = Crypt::decryptString($request->input('id'));
	   } catch (DecryptException $e) {
	      echo "Encryption is not decrypt this hash: " . $e;
	   }
	   echo $id;
	   */
	   
	   $request->validate([
	   'id' => 'required|numeric',
	   'quantity' => 'required|numeric|max:5'
	   ]);
	   /*
	   try {
	      $product = Product::find(Crypt::decryptString($request->input('id')));
	   } catch (DecryptException $e) {
	      echo "Unable to decrypt this hash: " . $e;
	   }
	   
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
		'attributes' => array(
                'image' => $product->image
            ),
            'associatedModel' => 'Product',
            'conditions' => $condition
		]);
		return redirect()->route('cart.index')->with('success', 'Item is Added to Cart!');
		*/
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