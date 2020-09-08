@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{ \Cart::getTotalQuantity() }}</span>
      </h4>
      <ul class="list-group mb-3">
      @foreach (\Cart::getContent() as $item)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{ $item->name }}</h6>
          </div>
          <small>Qty: {{ $item->quantity }}</small>
          <span class="text-muted">${{ $item->getPriceSumWithConditions() }}</span>
        </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-danger">
            <h6 class="my-0">VAT({{ config('settings.vat') . '%' }})</h6>
          </div>
          <span class="text-danger">${{ $totalvat }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>${{ $total }}</strong>
        </li>
      </ul>
    </div>
    
    
    <div class="col-sm-6">
    <div class="card bg-white rounded shadow-lg mb-5">
      <div class="card-body">
	  
          <form id="payment-form" action="{{ route('checkout') }}" method="POST">
         @csrf
          <h2 class="text-info" align="center">Order Informations</h2>
          
        <label for="card-element">
        Credit or debit card
        </label>
        <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
        </div>
 
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
  <button type="submit" class="btn btn-primary">Pay</button>
  </form>
<script>
// Create a Stripe client.
var stripe = Stripe('{{ config("settings.stripe_publishable")}}');
 
// Create an instance of Elements.
var elements = stripe.elements();
 
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
 
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
 
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
 
// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
 
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
 
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});
 
// Submit the form with the token ID.
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'token');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
 
    // Submit the form
    form.submit();
}
</script>
    </div>
  </div>
  </div>
    
    
    
  </div>
  <script src="{{ asset('js/') }}" defer></script>
  @endsection