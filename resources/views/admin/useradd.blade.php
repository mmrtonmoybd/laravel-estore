@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Create User</h1>
          <p>User Adding To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.user.add') }}">Create User</a></li>
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
                <form action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="exampleInputTitle" type="text" aria-describedby="TitleHelp" placeholder="Enter Name" name="name" required value="{{ old('name') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="exampleInputQty1" type="email" placeholder="User Email" name="email" required value="{{ old('email')  }}">
                  </div>
                  
                  
				  <div class="form-group">
                    <label for="exampleInputqty1">User Address</label>
                    <input class="form-control @error('address') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="User Address" name="address" value="{{ old('address') }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Mobile</label>
                    <input class="form-control @error('mobile') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="User Mobile" name="mobile" value="{{ old('mobile') }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="User Password" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Password Confrimation</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="User Password Confrimation" name="password_confirmation" required>
                  </div>
                    
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection