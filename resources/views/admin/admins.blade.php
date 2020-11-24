@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Admins</h1>
          <p>Display All Admins</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Admins</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-title-w-btn">
              <h3 class="title">All Admins</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.admin.add') }}"><i class="fa fa-plus"></i> Create Admin</a></p>
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
                <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="sampleTable_length">
                <label>Order By: 
                  <select name="sampleTable_length" aria-controls="sampleTable" class="form-control form-control-sm">
                    <option onClick="window.location = '{{ route("admin.admin.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.admin.list") }}?order=older'">Oldest</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Admin Name</th>
                      <th>Admin Email</th>
                      <th>Admin Permission</th>
                      <th>Home Address</th>
                      <th>Admin Mobile</th>
                      <th>Admin Facebook</th>
                      <th>Admin IP</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($admins as $admin)
                  <tr>
                      <td>{{ $admin->id }}</td>
                      <td>{{ $admin->name }}</td> 
                      <td>{{ $admin->email }}</td> 
                      <td>@if ($admin->isAdmin == 1) {{ "Super Admin"}} @else {{ "Normal Admin"}} @endif</td>
                      <td>{{ $admin->adminInfo->address }}</td>
                      <td>{{ $admin->adminInfo->mobile }}</td>
                      <td>{{ $admin->adminInfo->facebook }}</td>
                      <td>{{ $admin->adminInfo->ip }}</td>
                      <td>{{ $admin->updated_at }}</td>
                      <td>{{ $admin->created_at }}</td>
					  <td>@if (Auth::guard('admin')->user()->id !== $admin->id)<div class="btn-group"><a class="btn btn-primary" href=''><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="{{ route('admin.admin.update', ['id' => $admin->id]) }}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.admin.delete', ['id' => $admin->id ])}}"><i class="fa fa-lg fa-trash"></i></a></div> @else This admin is current user.@endif</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $admins->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection