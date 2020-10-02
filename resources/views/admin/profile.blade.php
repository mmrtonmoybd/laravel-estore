@extends('layouts.admin')
@section('content')
<div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="{{ (!is_null($profile->image)) ? asset($profile->image) : 'https://st2.depositphotos.com/1006318/5909/v/950/depositphotos_59095529-stock-illustration-profile-icon-male-avatar.jpg' }}">
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
            <div class="tile">
              <table class="table table-striped">
              @if(session()->has('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session()->get('success') }}
       </div>
       @endif
			  <thead>
<tr>
<th>Name: </th>
<td>{{ $profile->name }}</td>
</tr>
@if (Auth::guard('admin')->user()->isAdmin == 1 && Auth::guard('admin')->user()->id != $profile->id)
<tr>
<th>Email Address: </th>
<td>{{ $profile->email }}</td>
</tr>
<tr>
<th>Facebook: </th>
<td><a href="{{ $profile->adminInfo->facebook }}">{{ $profile->name }}</a></td>
</tr>
<tr>
<th>Home Address: </th>
<td>{{ $profile->adminInfo->address }}</td>
</tr>
<tr>
<th>Mobile Phone: </th>
<td>{{ $profile->adminInfo->mobile }}</td>
</tr>
<tr>
<th>IP Address: </th>
<td>{{ $profile->adminInfo->ip }}</td>
</tr>
@endif
@can('adminAuthorize', $profile)
<tr>
<th>Email Address: </th>
<td>{{ $profile->email }}</td>
</tr>
<tr>
<th>Facebook: </th>
<td><a href="{{ $profile->adminInfo->facebook }}">{{ $profile->name }}</a></td>
</tr>
<tr>
<th>Home Address: </th>
<td>{{ $profile->adminInfo->address }}</td>
</tr>
<tr>
<th>Mobile Phone: </th>
<td>{{ $profile->adminInfo->mobile }}</td>
</tr>
<tr>
<th>IP Address: </th>
<td>{{ $profile->adminInfo->ip }}</td>
</tr>
@endcan

</thead>
			  </table>
            </div>
            
          </div>
        </div>
      </div>
@endsection