@extends('layouts.app')
@section('content')
<form action="{{ route('profile.update', ['id' => $profile->id ]) }}" method="POST" enctype="multipart/form-data">
@csrf
@foreach($errors->all() as $error)
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ $error }}
       </div>
       @endforeach
<div class="form-group">
    <label for="exampleInputName">Full Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter name" value="{{ $profile->name }}" name="name">
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value={{ $profile->email }} disabled>
  
  </div>
  <div class="form-group">
    <label for="exampleInputAddress">Home address</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="exampleInputAddress" aria-describedby="addressHelp" placeholder="Enter home address" value="{{ $userinfo->address }}" name="address">
  
  </div>
  <div class="form-group">
    <label for="exampleInputMobile">Email address</label>
    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="exampleInputMobile" aria-describedby="mobileHelp" placeholder="Enter mobile" value={{ $userinfo->mobile }} name="mobile">
  
  </div>
  <div class="form-group">
    <label for="exampleInputFacebook">Facebook Profile</label>
    <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="exampleInputFacebook" aria-describedby="addressHelp" placeholder="Enter Facebook Profile" value="{{ $userinfo->facebook }}" name="facebook">
  
  </div>
  <div class="form-group">
    <label for="exampleInputImage">Profile picture</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="exampleInputImage" aria-describedby="imageHelp" placeholder="Profile picture" name="image">
  
  </div>
  
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
  <div class="form-group">
    <label for="cpassword">Confrim Password</label>
    <input type="password" class="form-control @error('cpassword') is-invalid @enderror" id="exampleInputPassword2" placeholder="Confrim Password" name="password_confirmation">
  </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection