@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Users</h1>
          <p>Display All Users</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Users</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-title-w-btn">
              <h3 class="title">All Users</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.user.add') }}"><i class="fa fa-plus"></i>Add User</a></p>
              </div>
            <div class="tile-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
		
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>Home Address</th>
                      <th>User Mobile</th>
                      <th>User Facebook</th>
                      <th>User IP</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td> 
                      <td>{{ $user->email }}</td>  
                      <td>{{ $user->userInfo->address }}</td>
                      <td>{{ $user->userInfo->mobile }}</td>
                      <td>{{ $user->userInfo->facebook }}</td>
                      <td>{{ $user->userInfo->ip }}</td>
                      <td>{{ $user->updated_at }}</td>
                      <td>{{ $user->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href='{{ url("/users/profile/{$user->id}") }}'><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="{{ route('admin.user.update', ['id' => $user->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href=""><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection