@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Categories</h1>
          <p>Display All Category</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Categories</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Categories</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.category.add') }}"><i class="fa fa-plus"></i>Add Category</a></p>
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
                    <option onClick="window.location = '{{ route("admin.category.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.category.list") }}?order=older'">Oldest</option>
                    <option onClick="window.location = '{{ route("admin.category.list") }}?order=low'">Products Low => High</option>
                    <option onClick="window.location = '{{ route("admin.category.list") }}?order=high'">Products High => Low</option>
                  </select></label>
                  </div>
                </div>
                </div>
                <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Products</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($categorys as $category)
                  <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>       
                      <td>{{ $category->description }}</td>
                      <td>{{ $category->products }}</td>
                      <td>{{ $category->updated_at }}</td>
                      <td>{{ $category->created_at }}</td>
					  <td><div class="btn-group">@if ($category->products > 0)<a class="btn btn-primary" href='{{ url("/category/{$category->id}")}}'><i class="fa fa-lg fa-eye"></i></a>@endif<a class="btn btn-primary" href="{{ route('admin.category.update', ['id' => $category->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.category.delete', ['id' => $category->id ])}}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $categorys->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection