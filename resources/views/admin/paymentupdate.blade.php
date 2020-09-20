@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Payment Update</h1>
          <p>Payment Updating To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Payments</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.category.add') }}">Payment update</a></li>
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
                <form action="{{ route('admin.payment.update', ['id' => $payment->id ]) }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Shipping Address</label>
                    <input class="form-control @error('address') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Address" name="address" required value="{{ old('address') ? old('address') : $payment->address }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Shipping Mobile</label>
                    <input class="form-control @error('mobile') is-invalid @enderror" id="exampleInputName" type="number" aria-describedby="NameHelp" placeholder="Enter Mobile" name="mobile" required value="{{ old('mobile') ? old('mobile') : $payment->mobile }}">
                  </div>
                
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection