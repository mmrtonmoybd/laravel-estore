<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Events\PaymentSuccess;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;
use Omnipay\Omnipay;
use Stripe\StripeClient;

class Checkout extends Controller
{
    public $vat;

    public function __construct()
    {
        $this->middleware(['auth', 'checkout']);
    }

    public function index()
    {
        // Checkout form with stripe js
        return view('checkout', [
            'total' => $this->getTotalWithVat(Cart::getTotal()),
            'totalvat' => $this->vat,
        ]);
    }

    // our main method, We need to validate request then Checkout, after checkout store data in Payment table with Payment id. Also store order information in Order table.
    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|max:450|string',
            'mobile' => 'required|numeric',
            'cardnumber' => ['required', new CardNumber()],
            'expmonth' => ['required', new CardExpirationMonth($request->input('expyear'))],
            'expyear' => ['required', new CardExpirationYear($request->input('expmonth'))],
            'cvv' => ['required', new CardCvc($request->input('cardnumber'))],
        ]);

        try {
            // Use Stripe's library to make requests...
            $stripe = new StripeClient(Setting::getValue('stripe_public'));
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->input('cardnumber'),
                    'exp_month' => $request->input('expmonth'),
                    'exp_year' => $request->input('expyear'),
                    'cvc' => $request->input('cvv'),
                    'address_country' => 'Bangladesh',
                    'address_line1' => $request->input('address'),
                ], ]);
            //echo $token->id;
            //dd($token);

            $omnipay = Omnipay::create('Stripe');
            $omnipay->setApiKey(Setting::getValue('stripe_secret'));
            $response = $omnipay->purchase([
                'amount' => $this->getTotalWithVat(Cart::getTotal()),
                'currency' => Setting::getValue('currency'),
                'token' => $token->id,
            ])->send();

            if ($response->isRedirect()) {
                return $response->redirect();
            }
            if ($response->isSuccessful()) {
                // Payment is successful
                //dd($response->getData());

                $data = $response->getData();
                $payment_id = $data['id'];
                $getPayment = Payment::where('payment_id', $payment_id)->first();
                if (!$getPayment) {
                    $payment = Payment::create([
                        'payment_id' => $payment_id,
                        'mobile' => $request->input('mobile'),
                        'amount' => $this->getTotalWithVat(Cart::getTotal()),
                        'address' => $request->input('address'),
                        'user_id' => Auth::guard()->user()->id,
                        'payment_type' => 'checking',
                    ]);

                    foreach (Cart::getContent() as $item) {
                        $product = Product::find($item->id);
                        if ($product->quantity >= $item->quantity) {
                            $product->quantity = $product->quantity - $item->quantity;
                        } else {
                            $product->quantity = 0;
                        }
                        $product->save();
                        $datao = [
                            'payment_id' => $payment->id,
                            'product_id' => $item->id,
                            'quantity' => $item->quantity,
                            'user_id' => Auth::guard()->user()->id,
                            'size' => $item->attributes->size,
                            'color' => $item->attributes->color,
                        ];
                        Order::create($datao);
                    }

                    event(new PaymentSuccess(Auth::guard()->user(), Payment::find($payment->id)));
                    Cart::clear();

                    return redirect("users/orders/{$payment->id}")->with('success', 'Your payment and order are successful');
                }

                return redirect()->back()->with('error', 'Your payment id is already avilable in our server or your payment and order is successfully.');
            }

            return redirect()->back()->with('error', $response->getMessage());
        } catch (\Stripe\Exception\CardException $e) {
            // echo 'Message is:' . $e->getError()->message . '\n';
            return redirect()->back()->with('error', $e->getError()->message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function setVat($value)
    {
        $this->vat = $value;

        return $this->vat;
    }

    private function getTotalWithVat($value)
    {
        $vat = Setting::getValue('vat');
        $calculation = $value * $vat / 100;
        $this->setVat($calculation);
        $calculation = $value + $calculation;

        return ceil($calculation);
    }
}
