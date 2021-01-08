@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Admin Update</h1>
          <p>Admin Update To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.admin.update', ['id' => $admin->id]) }}">Admin Update</a></li>
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
                <form action="{{ route('admin.admin.update', ['id' => $admin->id]) }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="exampleInputTitle" type="text" aria-describedby="TitleHelp" placeholder="Admin Name" name="name" required value="{{ old('name') ? old('name') : $admin->name }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Admin Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="exampleInputQty1" type="email" placeholder="Admin Email" name="email" required value="{{ old('email') ? old('email') : $admin->email }}">
                  </div>
                  
                  
				  <div class="form-group">
                    <label for="exampleInputqty1">Admin Address</label>
                    <input class="form-control @error('address') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="Admin Address" name="address" value="{{ old('address') ? old('address') : $admin->adminInfo->address }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Admin Mobile</label>
                    <input class="form-control @error('mobile') is-invalid @enderror" id="exampleInputDiscounds1" type="text" placeholder="User Mobile" name="mobile" value="{{ old('mobile')  ? old('mobile') : $admin->adminInfo->mobile }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Admin Facebook</label>
                    <input class="form-control @error('facebook') is-invalid @enderror" id="exampleInputDiscounds1" type="url" placeholder="Admin Facebook" name="facebook" value="{{ old('facebook') ? old('facebook') : $admin->adminInfo->facebook }}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Admin Permission</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="exampleSelect1" name="status" required>
                      <option value="0" @if ($admin->isAdmin == 0) selected @endif>Normal Admin</option>
                      <option value="1" @if ($admin->isAdmin == 1) selected @endif>Super Admin</option>
                    </select>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Admin Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="Admin Password" name="password">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputqty1">Admin Password Confrimation</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="exampleInputDiscounds1" type="password" placeholder="Admin Password Confrimation" name="password_confirmation">
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