@extends('layouts.app')
@section('content')
<table class="table table-striped">
@if(session()->has('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session()->get('success') }}
       </div>
       @endif
<img src='{{ url("/") . "/" . $userinfo->image }}' class="rounded-circle" alt="Cinque Terre" width="200" height="150">
<thead>
<tr>
<th>Name: </th>
<td>{{ $profile->name }}</td>
</tr>
@can('isAuthorize', $profile)
<tr>
<th>Email Address: </th>
<td>{{ $profile->email }}</td>
</tr>
<tr>
<th>Facebook: </th>
<td><a href="//{{ $userinfo->facebook }}">{{ $profile->name }}</a></td>
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