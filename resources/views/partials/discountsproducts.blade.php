<div class="page-header">
  <h2>Discounded Products</h2>
</div>
@foreach ($discounds as $discound) 
<div class=" col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="{{ asset($discound->image) }}" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$discound->id}") }}'>{{ $discound->title }}</a>
                </h4>
           @php
                $price = $discound->price;
                $adiscound = $discound->discounds;
                $calculate = $price * $adiscound / 100;
                $calculate = $price - $calculate;
                @endphp
                <h5>@if ($calculate == 0) 
                {{ \App\Setting::getValue('currency_icon') }}{{ $price }}
                @else 
                <del>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $price }}</del>  {{ \App\Models\Setting::getValue('currency_icon') }}{{ $calculate }}
                @endif</h5>
              </div>
              <div class="card-footer">
             <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ \Crypt::encryptString($discound->id) }}" id="id" name="id">
 
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