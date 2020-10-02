@extends('layouts.admin')
@section('content')
<div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg">
              <h4>{{ $profile->name }}</h4>
              <p>@if ($profile->isAdmin == 1) {{ "Super Admin"}} @else {{ "Normal Admin"}} @endif</p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'admin.profile' ? 'active' : '' }}" href="{{ route('admin.profile', ['id' => $profile->id]) }}">Profile</a></li>
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName() == 'admin.profile.update' ? 'active' : '' }}" href="{{ route('admin.profile.update', ['id' => $profile->id]) }}">Profile Update</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tile">
              <table class="table table-striped">
			  <thead>
<tr>
<th>Name: </th>
<td>{{ $profile->name }}</td>
</tr>
@if (\Auth::guard('admin')->check())
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


</thead>
			  </table>
            </div>
            
          </div>
        </div>
      </div>
@endsection