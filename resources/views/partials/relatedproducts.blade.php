<div class="page-header">
  <h2>Related Products</h2>
@foreach ($relatedproducts as $relatedproduct) 
<div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href='{{ url("product/{$relatedproduct->id}") }}'>{{ $relatedproduct->title }}</a>
                </h4>
           @php
		   /**
              $calculation = $discound->price * $discound->discounds / 100;
              $calculation = $discound->price - $calculation; 
			  **/
           @endphp     <h5>৳{{ $relatedproduct->price }}</h5>
                <p class="card-text">{{ $relatedproduct->description }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
          @endforeach
</div>