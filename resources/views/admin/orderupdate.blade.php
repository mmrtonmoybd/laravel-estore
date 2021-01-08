@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Order Update</h1>
          <p>Order Update To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Orders</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.product.add') }}">Order Update</a></li>
        </ul>
      </div>
	  
	  <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">
              @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
                <form action="{{ route('admin.order.update', ['id' => $order->id]) }}" method="POST">
                @csrf
				
                  <div class="form-group">
                    <label for="exampleSelect1">Order Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="exampleSelect1" name="status" required>
                      <option value="complete" @if ($order->status == 'complete') selected @endif>Complete</option>
                      <option value="pending" @if ($order->status == 'pending') selected @endif>Pending</option>
                    </select>
                  </div>
                 
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection