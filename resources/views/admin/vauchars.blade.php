@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-percent"></i> Vauchars</h1>
          <p>Display All Vauchar</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Vauchars</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Vauchar</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.vauchar.add') }}"><i class="fa fa-percent"></i> Create Vauchar</a></p>
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
                    <option onClick="window.location = '{{ route("admin.vauchar.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.vauchar.list") }}?order=older'">Oldest</option>
                    <option onClick="window.location = '{{ route("admin.vauchar.list") }}?order=qlow'">Quantity Low => High</option>
                    <option onClick="window.location = '{{ route("admin.vauchar.list") }}?order=qhigh'">Quantity High => Low</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Type</th>
                      <th>User/Product ID</th>
                      <th>Code</th>
                      <th>Quantity</th>
                      <th>Value Type</th>
                      <th>Value</th>
                      <th>Used</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($vauchars as $vauchar)
                  <tr>
                      <td>{{ $vauchar->id }}</td>
                      <td>{{ $vauchar->title }}</td>      
                      <td>{{ $vauchar->type }}</td>
                      <td>@if (!is_null($vauchar->product_id)) {{ $vauchar->product_id }} @else {{ $vauchar->user_id }} @endif </td>
                      <td>{{ $vauchar->code }}</td>
                      <td>{{ $vauchar->quantity }}</td>
                      <td>{{ $vauchar->vtype }}</td>
                      <td>{{ $vauchar->vaule }}</td>
                      <td>{{ $vauchar->used }}</td>
                      <td>{{ $vauchar->updated_at }}</td>
                      <td>{{ $vauchar->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href="{{ route('admin.vauchar.update', ['id' => $vauchar->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.vauchar.delete', ['id' => $vauchar->id ]) }}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $vauchars->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection