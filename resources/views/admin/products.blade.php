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
            <div class="tile-body">
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
                      <th>Admin Name</th>
                      <th>Sells</th>
                      <th>Updated</th>
                      <th>Created</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $product)
                  <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->title }}</td>
          @php
          //$category = \App\Product::categorya($product->id);
          @endphp       
                      <td>{{ $product->category->name }}</td>
                      <td>${{ $product->price }}</td>
                      <td>{{ $product->discounds }}</td>
                      <td>{{ $product->views }}</td>
                      <td>{{ $product->quantity }}</td>
                      <td>{{ $product->admin->name }}</td>
                      <td>{{ \App\Product::order($product->id) }}</td>
                      <td>{{ $product->updated_at }}</td>
                      <td>{{ $product->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection