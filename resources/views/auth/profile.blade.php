@extends('layouts.app')
@section('content')
<table class="table table-striped">
<thead>
<tr>
<th>Name: </th>
<td>{{ $profile->name }}</td>
</tr>
@can('isAuthorize', $profile)
<tr>
<th>Facebook: </th>
<td><a href="{{ $profile->userInfo()->facebook }}">{{ $profile->name }}</a></td>
</tr>
@endcan
</thead>
</table>
@endsection