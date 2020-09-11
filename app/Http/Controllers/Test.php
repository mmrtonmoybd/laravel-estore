<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use Stripe\StripeClient;
use Stripe\Exception\CardException;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function test() {
        /*
        try {
            $stripe = new StripeClient(config('settings.stripe_publishable'));
        $token = $stripe->tokens->create([
        'card' => [
        'number' => '5555555555774444',
        'exp_month' => 12,
        'exp_year' => 2020,
        'cvc' => '123',
        ]
        ]);
        } catch (CardException $e) {
            echo "Error: " . $e->getMessage();
        }
        echo $token;
        */
       try {
  // Use Stripe's library to make requests...
  $stripe = new StripeClient(config('settings.stripe_publishable'));
        $token = $stripe->tokens->create([
        'card' => [
        'number' => '5555555555534444',
        'exp_month' => 12,
        'exp_year' => 2020,
        'cvc' => '123',
       // 'email' => 'rmedha037@gmail.com',
        'address_country' => 'Bangladesh',
        'address_city' => 'Mymensingh',
        'address_line1' => '187/6 Maskanda, Mymensingh',
        ]]);
        //echo $token->id;
        
} catch(\Stripe\Exception\CardException $e) {
  // Since it's a decline, \Stripe\Exception\CardException will be caught
  echo 'Status is:' . $e->getHttpStatus() . '\n';
  echo 'Type is:' . $e->getError()->type . '\n';
  echo 'Code is:' . $e->getError()->code . '\n';
  // param is '' in this case
  echo 'Param is:' . $e->getError()->param . '\n';
  echo 'Message is:' . $e->getError()->message . '\n';
} catch (\Stripe\Exception\RateLimitException $e) {
  // Too many requests made to the API too quickly
  echo $e->getError()->message;
} catch (\Stripe\Exception\InvalidRequestException $e) {
  // Invalid parameters were supplied to Stripe's API
  echo $e->getError()->message;
} catch (\Stripe\Exception\AuthenticationException $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
  echo $e->getError()->message;
} catch (\Stripe\Exception\ApiConnectionException $e) {
  // Network communication with Stripe failed
  echo $e->getError()->message;
} catch (\Stripe\Exception\ApiErrorException $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email
  echo $e->getError()->message;
} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe
  echo $e->getError()->message;
}
    }
}