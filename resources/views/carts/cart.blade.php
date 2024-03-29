@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(\Cart::getTotalQuantity() > 0)
                    <h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="/" class="btn btn-dark">Continue Shopping</a>
                @endif

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ asset($item->attributes->image) }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href='{{ url("product/{$item->id}") }}'>{{ $item->name }}</a></b><br>
                                <b>Color:</b>  {{ $item->attributes->color }}<br>
                                <b>Size:</b>  {{ $item->attributes->size }}<br>
                                <b>Price: </b>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $item->price }}<br>
                        
								<b>With Discount: </b>{{ \App\Models\Setting::getValue('currency_icon') }}{{ $item->getPriceSumWithConditions() }}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ \Crypt::encryptString($item->id) }}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                               id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                             <div class="form-group">
                    <label for="exampleSelect1">Color</label>
                    <select class="form-control @error('color') is-invalid @enderror" id="exampleSelect1" name="color" required>
                    @php
                    $colors = explode(',', $item->associatedModel->color);
                    @endphp
                    
                    @foreach ($colors as $color)
                      <option value="{{ $color }}" @if ($color == $item->attributes->color) selected @endif>{{ $color }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Size</label>
                    <select class="form-control @error('size') is-invalid @enderror" id="exampleSelect1" name="size" required>
                    @php
                    $sizes = explode(',', $item->associatedModel->size);
                    @endphp
                    
                    @foreach ($sizes as $size)
                      <option value="{{ $size }}" @if ($size == $item->attributes->size) selected @endif>{{ $size }}</option>
                      @endforeach
                    </select>
                  </div>                  
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Clear Cart</button>
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
							<b>Total: </b>{{ \App\Models\Setting::getValue('currency_icon') }}{{ \Cart::getTotal() }}</li>
                        </ul>
                    </div>
                    <br><a href="{{ url('/') }}" class="btn btn-dark">Continue Shopping</a>
                    <a href="{{ route('checkout') }}" class="btn btn-success">Proceed To Checkout</a>
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection