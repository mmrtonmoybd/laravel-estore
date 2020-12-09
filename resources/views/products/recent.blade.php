@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item"><a href='{{ url("all/products") }}'>All Products</a></li>
  </ol>
</nav>
<div class="row">
@include('partials.categorylist')
</div>
<div class="row">
    <div class="form-group">
      <label for="order">Order By</label>
      <div class="">
        <select class="form-control">
          <option onClick="window.location = '{{ url("all/products") }}'">Latest(Default)</option>
          <option onClick="window.location = '{{ url("all/products?order=older") }}'">Oldest</option>
          <option onClick="window.location = '{{ url("all/products?order=low") }}'">Low => High</option>
          <option onClick="window.location = '{{ url("all/products?order=high") }}'">High => Low</option>
        </select> 
      </div>
    </div>

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
                {{ \App\Models\Setting::getValue('currency_icon') }}{{ $price }}
                @else 
                <del>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $price }}</del>  {{ \App\Models\Setting::getValue('currency_icon') }}{{ $calculate }}
                @endif</h5>
              </div>
              <div class="card-footer">
          <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ \Crypt::encryptString($product->id) }}" id="id" name="id">
 
                                        <input type="hidden" value="1" id="quantity" name="quantity">
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
                                               <button class="btn btn-secondary btn-sm tooltip-test" type="submit" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                    </form> 
              </div>
            </div>
          </div>
          @endforeach
		  </div>
		  {{ $products->links() }}
                                    </form> 
              </div>
            </div>
          </div>
		  </div>
		  {{ $products->links() }}
		  @endsection