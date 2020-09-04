@extends('layouts.app')
@section('content')
<div class="row">
@include('partials.categorylist')
</div>
<div class="row">

@foreach ($products as $product) 

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$product->id}") }}'>{{ $product->title }}</a>
                </h4>
                <h5>৳{{ $product->price }}</h5>
                <p class="card-text">{{ $product->description }}</p>
              </div>
              <div class="card-footer">
			  <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ \Crypt::encryptString($product->id) }}" id="id" name="id">
 
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
              </div>
            </div>
          </div>
          @endforeach
          @include('partials.discountsproducts')
		  </div>
		  @endsection