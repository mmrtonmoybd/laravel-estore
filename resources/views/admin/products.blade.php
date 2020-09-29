@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Products</h1>
          <p>Display All Products</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Products</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Products</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.product.add') }}"><i class="fa fa-plus"></i>Add Product</a></p>
            </div>
            <div class="tile-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
		
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Discounds</th>
                      <th>Views</th>
                      <th>Quantitys</th>
                      <th>Review</th>
                      <th>Color</th>
                      <th>Size</th>
                      <th>Admin Name</th>
                      <th>Sells</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $product)
                  <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->title }}</td>      
                      <td>{{ $product->category->name }}</td>
                      <td>${{ $product->price }}</td>
                      <td>{{ $product->discounds }}</td>
                      <td>{{ $product->views }}</td>
     @if ($product->quantity < 1)                 <td class="btn btn-danger">{{ $product->quantity }} </td>
     @else
     <td>{{ $product->quantity }} </td>
     @endif
     <td>@php
            $rating = round($product->averageRating, 2);
            @endphp
			<span class="text-warning" >@for ($i = 1; $i <= 5; $i++) @if ($rating >= $i){!! '&#9733;' !!} @else {!! '&#9734;' !!} @endif @endfor</span></td>
     <td>{{ $product->color }}</td>
     <td>{{ $product->size }}</td>
                      <td>{{ $product->admin->name }}</td>
                      <td>{{ \App\Product::order($product->id) }}</td>
                      <td>{{ $product->updated_at }}</td>
                      <td>{{ $product->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href='{{ url("/product/{$product->id}") }}'><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="{{ route('admin.product.update', ['id' => $product->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.product.delete', ['id' => $product->id ]) }}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection