@extends('layouts.app')
@section('content')
<table class="table table-striped">
@if(session()->has('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session()->get('success') }}
       </div>
       @endif
	   @can('isAuthorize', $profile)
	   <a href='{{ route("profile.update", ["id" => $profile->id ])}}'><button type="button" class="btn btn-info">Update profile</button></a>
	   @endcan
<img src='{{ asset($userinfo->image) }}' class="rounded-circle" width="200" height="150" alt="{{ $profile->name }}">
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
<td><a href="{{ $userinfo->facebook }}">{{ $profile->name }}</a></td>
</tr>
<tr>
<th>Home Address: </th>
<td>{{ $userinfo->address }}</td>
</tr>
<tr>
<th>Mobile Phone: </th>
<td>{{ $userinfo->mobile }}</td>
</tr>
<tr>
<th>IP Address: </th>
<td>{{ $userinfo->ip }}</td>
</tr>
@endif
@can('isAuthorize', $profile)
<tr>
<th>Email Address: </th>
<td>{{ $profile->email }}</td>
</tr>
<tr>
<th>Facebook: </th>
<td><a href="{{ $userinfo->facebook }}">{{ $profile->name }}</a></td>
</tr>
<tr>
<th>Home Address: </th>
<td>{{ $userinfo->address }}</td>
</tr>
<tr>
<th>Mobile Phone: </th>
<td>{{ $userinfo->mobile }}</td>
</tr>
<tr>
<th>IP Address: </th>
<td>{{ $userinfo->ip }}</td>
</tr>
@endcan
</thead>
</table>
@endsection