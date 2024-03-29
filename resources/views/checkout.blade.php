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
          <span class="text-muted">{{ \App\Models\Setting::getValue('currency_icon') }}{{ $item->getPriceSumWithConditions() }}</span>
        </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-danger">
            <h6 class="my-0">VAT({{ \App\Models\Setting::getValue('vat') . '%' }})</h6>
          </div>
          <span class="text-danger">{{ \App\Models\Setting::getValue('currency_icon') }}{{ $totalvat }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total ({{ \App\Models\Setting::getValue('currency') }})</span>
          <strong>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $total }}</strong>
        </li>
      </ul>
      <form class="card p-2" action="{{ route('promo') }}" method="POST">
        @csrf
            <div class="form-group">
              <input type="text" class="form-control @error('code') 
    is-invalid 
    @enderror" placeholder="Promo code" name="code">
              
</div>
                <button type="submit" class="btn btn-secondary">Redeem</button>
          </form>
    </div>
    
    
    <div class="col-md-8 order-md-1">
      @foreach($errors->all() as $error)
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ $error }}
       </div>
       @endforeach
       @if(session()->has('error'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ session()->get('error') }}
       </div>
       @endif
       @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
	  
          <form id="payment-form" action="{{ route('checkout') }}" method="POST">
         @csrf
          <h2 class="text-info" align="center">Order Informations</h2>
  
  <div class="form-group">
    <label for="address">Shipping Address</label>
    <input type="text" class="form-control @error('address') 
    is-invalid 
    @enderror" id="address" aria-describedby="address" placeholder="Enter Shipping Address" name="address" value="{{ old('address') }}" required>
  </div>
  
 <div class="form-group">
    <label for="address">Mobile Number</label>
    <input type="text" class="form-control @error('mobile') 
    is-invalid 
    @enderror" id="mobile" aria-describedby="mobile" placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required>
  </div>
          
         <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="ccnum">Credit or Debit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111 2222 3333 4444" class="form-control @error('cardnumber') is-invalid @enderror" value="{{ old('cardnumber') }}" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="{{ date('m') }}" class="form-control @error('expmonth') is-invalid @enderror" value="{{ old('expmonth') }}" required>

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="{{ date('Y') }}" class="form-control @error('expyear') is-invalid @enderror" value="{{ old('expyear') }}" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" class="form-control @error('cvv') is-invalid @enderror" value="{{ old('cvv') }}" required>
              </div>
            </div>
          </div>
  <button type="submit" class="btn btn-primary">Pay</button>
  </form>
    </div>
    
    
    
  </div>
  @endsection