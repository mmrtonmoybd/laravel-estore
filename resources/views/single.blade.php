@extends('layouts.app')
@section('content')
<div class="row">
@include('partials.categorylist')

<div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
          <div class="card-body">
            <h3 class="card-title">{{ $product->title }}</h3>
            @php
                $price = $product->price;
                $discound = $product->discounds;
                $calculate = $price * $discound / 100;
                $calculate = $price - $calculate;
                @endphp
                <h4>@if ($calculate == 0) 
                ${{ $price }}
                @else 
                <del>${{ $price }}</del>  ${{ $calculate }}
                @endif</h4>
                <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ \Crypt::encryptString($product->id) }}" id="id" name="id">
 
                                        <input type="number" class="form-control form-control-sm" value="1"
                                               id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                    </form>
            <p class="card-text">{{ $product->description }}</p>
          </div>
          <form action="{{ route('user.comment') }}" method="POST">
@csrf
@foreach($errors->all() as $error)
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ $error }}
       </div>
       @endforeach
       @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
<div class="form-group">
    <label for="exampleInputName">Comment Content</label>
    <textarea class="form-control @error('comment') is-invalid @enderror" id="exampleInputName" aria-describedby="nameHelp" name="comment">{{ old('comment') }}</textarea>
  </div>
  <input type="hidden" value="{{ $product->id }}" id="id" name="id">
  
  <button type="submit" class="btn btn-primary">Comment</button>
</form>
        </div>
		@includeWhen($relatedbool, 'partials.relatedproducts', ['relatedproducts' => $relatedProductsv])
        @include('partials.discountsproducts')
</div>
@endsection