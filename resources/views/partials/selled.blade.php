<div class="page-header">
  <h2>Most Selled Products</h2>
@foreach ($selles as $discound) 
<div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$discound->product->id}") }}'>{{ $discound->product->title }}</a>
                </h4>
           @php
                $price = $discound->product->price;
                $adiscound = $discound->product->discounds;
                $calculate = $price * $adiscound / 100;
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
                                        <input type="hidden" value="{{ \Crypt::encryptString($discound->product->id) }}" id="id" name="id">
 
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                    </form>  
              </div>
            </div>
          </div>
          @endforeach
</div>