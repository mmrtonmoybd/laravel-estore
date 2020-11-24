@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-first-order"></i> Orders</h1>
          <p>Display All Orders</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Orders</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Orders</h3>
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
                 <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="sampleTable_length">
                <label>Order By: 
                  <select name="sampleTable_length" aria-controls="sampleTable" class="form-control form-control-sm">
                    <option onClick="window.location = '{{ route("admin.order.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.order.list") }}?order=older'">Oldest</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Payment ID</th>
                      <th>Product Title</th>
                      <th>Quantity</th>
                      <th>Size</th>
                      <th>Color</th>
                      <th>User</th>
                      <th>Status</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($orders as $order)
                  <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->payment_id }}</td>
                      <td><a href='{{ url("/product/{$order->product_id}") }}'>{{ $order->product->title }}</a></td>      
                      <td>{{ $order->quantity }}</td>
                      <td>{{ $order->size }}</td>
                      <td>{{ $order->color }}</td>
                      <td><a href='{{ url("/users/profile/{$order->user_id}") }}'>{{ $order->user->name }}</a></td>
                      <td>{{ $order->status }}</td>
                      <td>{{ $order->updated_at }}</td>
                      <td>{{ $order->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href="{{ route('admin.order.update', ['id' => $order->id]) }}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.order.delete', ['id' => $order->id]) }}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $orders->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection