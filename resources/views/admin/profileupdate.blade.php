@extends('layouts.admin')
@section('content')
<div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="{{ (!is_null($profile->adminInfo->image)) ? asset($profile->adminInfo->image) : 'https://st2.depositphotos.com/1006318/5909/v/950/depositphotos_59095529-stock-illustration-profile-icon-male-avatar.jpg' }}">
              <h4>{{ $profile->name }}</h4>
              <p>@if ($profile->isAdmin == 1) {{ "Super Admin"}} @else {{ "Normal Admin"}} @endif</p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              @can('adminAuthorize', $profile)
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'admin.profile' ? 'active' : '' }}" href="{{ route('admin.profile', ['id' => $profile->id]) }}">Profile</a></li>
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'admin.profile.update' ? 'active' : '' }}" href="{{ route('admin.profile.update', ['id' => $profile->id]) }}">Settings</a></li>
              @endcan
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
<div class="tab-pane active" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Settings</h4>
                <form action="{{ route('admin.profile.update', ['id' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($errors->all() as $error)
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ $error }}
       </div>
       @endforeach
                  <div class="row">
                  <div class="col-md-8 mb-4">
                      <label>Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter name" value="{{ old('name') ? old('name') : $profile->name }}" name="name" required>
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value={{ $profile->email }} disabled>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Home Address</label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror" id="exampleInputAddress" aria-describedby="addressHelp" placeholder="Enter home address" value="{{ old('address') ? old('address') : $profile->adminInfo->address }}" name="address" required>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Mobile No</label>
                      <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="exampleInputMobile" aria-describedby="mobileHelp" placeholder="Enter mobile" value={{ old('mobile') ? old('mobile') : $profile->adminInfo->mobile }} name="mobile" required>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Facebook</label>
                      <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputFacebook" aria-describedby="addressHelp" placeholder="Enter Facebook Profile" value="{{ old('facebook') ? old('facebook') : $profile->adminInfo->facebook }}" name="facebook" required>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Profile Picture</label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="exampleInputImage" aria-describedby="imageHelp" placeholder="Profile picture" name="image">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="clearfix"></div>
                   <div class="col-md-8 mb-4">
                      <label>Password Confirmation</label>
                      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleInputPassword2" placeholder="Confrim Password" name="password_confirmation">
                    </div>
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
			
			</div>
        </div>
      </div>
@endsection