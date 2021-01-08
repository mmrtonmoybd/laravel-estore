<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Models\Vauchar;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use SEO;
use Cart;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart as CartCart;

class CartController extends Controller
{
    public function index()
    {
        SEO::setTitle('Cart Items');
        SEO::opengraph()->setUrl(url('/cart/'));
        SEO::setCanonical(url('/cart/'));
        SEO::opengraph()->addProperty('type', 'page');

        return view('carts.cart', [
            'cartCollection' => Cart::getContent(),
        ]);
    }

    public function addProduct(CartRequest $request)
    {
        $request->validated();

        $product = Product::find($request->input('id'));

        $condition = new CartCondition([
            'name' => 'Discounds Offer',
            'type' => 'discound',
            'value' => "-{$product->discounds}%",
        ]);

        Cart::add([
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
            'conditions' => $condition,
        ]);

        return redirect()->route('cart.index')->with('success', 'Item is Added to Cart!');
    }

    public function removeProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        Cart::remove($request->input('id'));

        return redirect()->route('cart.index')->with('success', 'Item has been removed!');
    }

    public function updateProduct(CartRequest $request)
    {
        $request->validated();

        SEO::setTitle('Cart Update');
        SEO::opengraph()->setUrl(url('/cart/update/'));
        SEO::setCanonical(url('/cart/update/'));
        SEO::opengraph()->addProperty('type', 'page');
        Cart::update($request->input('id'), [
            'quantity' => [
                'relative' => false,
                'value' => $request->input('quantity'),
            ],
            'attributes' => [
                'color' => $request->input('color'),
                'size' => $request->input('size'),
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Item has been updated!');
    }

    public function cartClear()
    {
        Cart::clear();
        Cart::clearCartConditions();

        return redirect()->route('cart.index')->with('success', 'Cart has been cleared!');
    }

    public function promo(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:vauchars,code', 
        ]);

        $vauchar = Vauchar::where('code', $request->input('code'))->first();

        $vauf = Vauchar::find($vauchar->id);

        if ($vauchar->quantity <= $vauchar->used) {
            return redirect()->back()->withInput()->with('error', 'Promo code already exprired.');
        }
        
          $value = "-{$vauchar->vaule}";
          $value .=  ($vauchar->vtype == 'percent') ? "%" : "";

          $arr = [
            'name' => $vauchar->title,
            'type' => 'cupon',
            'value' =>  $value,
            'attributes' => [
                'id' => $vauchar->id,
            ],
            'order' => 1
            ];
          $cupon = new CartCondition($arr);

        if ($vauchar->type == 'user') {
            if ($vauchar->user_id != Auth::guard('web')->user()->getAuthIdentifier()) {
                return redirect()->back()->withInput()->with('error', 'You enter promo code is not for you.');
            }
             // add cart condition

             Cart::condition($cupon);

             $vauf->used++;
             $vauf->save();

             return redirect()->route('checkout')->with('success', 'Your promo code is added.');
        }

        if ($vauchar->type == 'product') {
            if (Cart::has($vauchar->product_id)) {
               Cart::addItemCondition($vauchar->product_id, $cupon);
               $vauf->used++;
               $vauf->save(); 
               return redirect()->route('checkout')->with('success', 'Your promo code is added.');
            } else {
                return redirect()->back()->with('error', 'You enter promo code is not for product that you added in cart.');
            }
        }
      return redirect()->back()->withInput();
    }

    public function uvauchar()
    {

        return view('auth.vauchar', [
          'vauchars' => Vauchar::where(['type' => 'user', 'user_id' => Auth::guard('web')->user()->getAuthIdentifier()])->paginate(\App\Models\Setting::getValue('item_per_page')),
        ]);
    }
}
