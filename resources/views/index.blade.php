@extends('layouts.app')
@section('content')
<div class="row">
@includeWhen($catebool,'partials.categorylist', ['categories' => $categories])
</div>
<div class="row">

@foreach ($products as $product) 

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="{{ asset($product->image) }}" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$product->id}") }}'>{{ $product->title }}</a>
                </h4>
                @php
                $price = $product->price;
                $discound = $product->discounds;
                $calculate = $price * $discound / 100;
                $calculate = $price - $calculate;
                @endphp
                <h5>@if ($calculate == 0) 
                ${{ $price }}
                @else 
                <del>${{ $price }}</del>  ${{ $calculate }}
                @endif</h5>
              </div>
              <div class="card-footer">
			  <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ \Crypt::encryptString($product->id) }}" id="id" name="id">
                                        @php 
                                        if (!function_exists('mrtattribute')) {
                                        function mrtattribute($attribute) {
                                         $arr = explode(',', $attribute);
                                         foreach ($arr as $arrnew) {
                                           $attribute = $arrnew;
                                           break;
                                         }
                                         return $attribute;
                                        }
                                        }
                                        @endphp
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <input type="hidden" name="color" value="{{ mrtattribute($product->color) }}" required>
                                        <input type="hidden" name="size" value="{{ mrtattribute($product->size) }}" required> 
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                    </form>
              </div>
            </div>
          </div>
          @endforeach
          @includeWhen($viewbool, 'partials.viewed', ['views' => $views])
          @includeWhen($disbool ,'partials.discountsproducts', ['discounds' => $discounds])
		  </div>
		  @endsection