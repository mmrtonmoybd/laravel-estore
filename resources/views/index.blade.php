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
                  <a href="#">{{ $product->title }}</a>
                </h4>
                <h5>৳{{ $product->price }}</h5>
                <p class="card-text">{{ $product->description }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
          @endforeach
          @include('partials.discountsproducts')
		  </div>
		  @endsection