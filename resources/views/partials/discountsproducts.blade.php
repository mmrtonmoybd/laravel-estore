<div class="page-header">
  <h2>Discounded Products</h2>
@foreach ($discounds as $discound) 
<div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$discound->id}") }}'>{{ $discound->title }}</a>
                </h4>
           @php
              $calculation = $discound->price * $discound->discounds / 100;
              $calculation = $discound->price - $calculation; 
           @endphp     <h5><del>৳{{ $discound->price }}</del> ৳{{ $calculation }}</h5>
                <p class="card-text">{{ $discound->description }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
          @endforeach
</div>