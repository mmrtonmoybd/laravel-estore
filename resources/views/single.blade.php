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
          <!-- You can start editing here. -->

	<h3 id="comments">
		{{ $product->totalCommentsCount() }} responses to &#8220;{{ $product->title }}&#8221;</h3>

	<div class="navigation">
		<div class="alignleft"></div>
		<div class="alignright"></div>
	</div>

	<ol class="commentlist">
	@foreach ($comments as $comment)
			<li class="comment even thread-even depth-1 parent" id="comment-10">
				<div id="div-comment-10" class="comment-body">
				<div class="comment-author vcard">
				@php
			if ($comment->commented_type == "App\Admin") {
				$user = $product->adminCom($comment->commented_id);
				$image = $user->adminInfo->image;
			} else {
				$user = $product->user($comment->commented_id);
				$image = $user->userInfo->image;
			}
			@endphp
			<img alt='' src='{{ asset($image) }}' class='avatar avatar-32 photo' height='32' width='32' />			<cite class="fn"> {{ $user->name }} @if ($comment->commented_type == "App\Admin") (Admin) @endif</cite> <span class="says">says:</span>		</div>
		
		<div class="comment-meta commentmetadata">
			{{ $comment->created_at }}
						</div>

		<p>{{ $comment->comment }}</p>
        @if (Auth::check())
		<div class="reply"><a rel='nofollow' class='comment-reply-link' href='{{ url("/product/{$product->id}?reply={$comment->id}") }}' data-commentid="{{ $comment->id }}" data-postid="{{ $product->id }}" data-belowelement="div-comment-10" data-respondelement="respond" aria-label='Reply to {{ $user->name }}'>Reply</a> 
	@can('isAction', $comment->id)
<a rel='nofollow' class='comment-edit-link' href='{{ route("com.edit", ["id" => $comment->id]) }}'>Edit</a>
<a rel='nofollow' class='comment-edit-link' href='{{ route("comment.delete", ["id" => $comment->id]) }}'>Delete</a>	
@endcan
</div>
@elseif (Auth::guard('admin')->check())
<div class="reply"><a rel='nofollow' class='comment-reply-link' href='{{ url("/product/{$product->id}?reply={$comment->id}") }}' data-commentid="{{ $comment->id }}" data-postid="{{ $product->id }}" data-belowelement="div-comment-10" data-respondelement="respond" aria-label='Reply to {{ $user->name }}'>Reply</a>
 <a rel='nofollow' class='comment-edit-link' href='{{ route("admin.comment.update", ["id" => $comment->id]) }}'>Edit</a>
<a rel='nofollow' class='comment-edit-link' href='{{ route("admin.comment.delete", ["id" => $comment->id]) }}'>Delete</a>
</div>
@endif
		
		@php
		$replys = \App\Comment::reply($comment->id);
		@endphp
		@if (count($replys) > 0)
		<ul class="children">
		@foreach ($replys as $reply )
		@php
			if ($reply->commented_type == "App\Admin") {
				$user = $product->adminCom($reply->commented_id);
				$image = $user->adminInfo->image;
			} else {
				$user = $product->user($reply->commented_id);
				$image = $user->userInfo->image;
			}
			@endphp
		<li class="comment byuser comment-author-admi2019 odd alt depth-2" id="comment-11">
				<div id="div-comment-11" class="comment-body">
				<div class="comment-author vcard">
			<img alt='' src='{{ asset($image) }}' class='avatar avatar-32 photo' height='32' width='32' />			<cite class="fn">{{ $user->name }}    @if ($reply->commented_type == "App\Admin") (Admin) @endif</cite> <span class="says">replis:</span>		</div>
		
		<div class="comment-meta commentmetadata">
			{{ $reply->created_at }}
						</div>

		<p>{{ $reply->comment }}</p>
		 @if (Auth::check())
		<div class="reply">
		@can('isAction', $reply->id)
<a rel='nofollow' class='comment-edit-link' href='{{ route("com.edit", ["id" => $reply->id]) }}'>Edit</a>
<a rel='nofollow' class='comment-edit-link' href='{{ route("comment.delete", ["id" => $reply->id]) }}'>Delete</a>	
@endcan
</div>
@elseif (Auth::guard('admin')->check())
<div class="reply">
<a rel='nofollow' class='comment-edit-link' href='{{ route("admin.comment.update", ["id" => $reply->id]) }}'>Edit</a>
<a rel='nofollow' class='comment-edit-link' href='{{ route("admin.comment.delete", ["id" => $reply->id]) }}'>Delete</a>	
</div>
@endif
				</div>
				</li><!-- #comment-## -->
				@endforeach
</ul><!-- .children -->
@endif


				</div>
				
</li><!-- #comment-## -->
@endforeach
		
	</ol>

	<div class="navigation">
		<div class="alignleft"></div>
		<div class="alignright"></div>
	</div>
@if (Auth::check() || Auth::guard('admin')->check())
	<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">Leave a Reply
		@if (Request::get('reply') !== null)
		<small><a rel="nofollow" id="cancel-comment-reply-link" href='{{ url("/product/{$product->id}") }}'>Cancel reply</a></small>
		@endif </h3>	
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
        		<form action="@if (Request::get('reply') !== null && Auth::check()) {{ route('user.reply') }} @elseif (Auth::check()) {{ route('user.comment') }} @elseif (Auth::guard('admin')->check() && Request::get('reply') !== null){{ route('admin.reply.add') }}@elseif (Auth::guard('admin')->check()) {{ route('admin.comment.add') }} @endif" method="POST" id="commentform" class="comment-form">
		@csrf
				<p class="comment-form-comment"><label for="comment">Comment</label> <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required">{{ old('comment') }}</textarea></p>
				@if (Request::get('reply') !== null) 
				<input type="hidden" name="cid" value="{{ Request::get('reply') }}">
				<input type="hidden" name="pid" value="{{ $product->id }}">
				@else
				<input type="hidden" name="id" value="{{ $product->id }}">
				@endif
				
<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" />
</p>			</form>
			</div><!-- #respond -->
			@else
			<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">You Must <a href="{{ route('login') }}">Login</a> To Comment Or Reply</h3>
</div>		  
			@endif
        </div>
		@includeWhen($relatedbool, 'partials.relatedproducts', ['relatedproducts' => $relatedProductsv])
        @include('partials.discountsproducts')
</div>
@endsection