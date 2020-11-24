@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> User Update</h1>
          <p>User Update To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.user.update', ['id' => $user->id]) }}">User Update</a></li>
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
                <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="exampleInputTitle" type="text" aria-describedby="TitleHelp" placeholder="Enter Name" name="name" required value="{{ old('name') ? old('name') : $user->name }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="exampleInputQty1" type="email" placeholder="User Email" name="email" required value="{{ old('email') ? old('email') : $user->email }}">
                  </div>
                  
                  
				  <div class="form-group">
                    <label for="exampleInputqty1">User Address</label>
                    <input class="form-control @error('address') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="User Address" name="address" value="{{ old('address') ? old('address') : $user->userInfo->address }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Mobile</label>
                    <input class="form-control @error('mobile') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="User Mobile" name="mobile" value="{{ old('mobile')  ? old('mobile') : $user->userInfo->mobile }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Facebook</label>
                    <input class="form-control @error('facebook') is-invalid @enderror" id="exampleInputDiscounds1" type="url" placeholder="User Facebook" name="facebook" value="{{ old('facebook') ? old('facebook') : $user->userInfo->facebook }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="User Password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">User Password Confrimation</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="User Password Confrimation" name="password_confirmation">
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