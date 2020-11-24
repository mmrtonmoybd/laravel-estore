@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Pages</h1>
          <p>Display All Pages</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Pages</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Pages</h3>
              <p><a class="btn btn-primary icon-btn" href="{{ route('admin.page.add') }}"><i class="fa fa-plus"></i> Create Page</a></p>
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
                    <option onClick="window.location = '{{ route("admin.page.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.page.list") }}?order=older'">Oldest</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($pages as $page)
                  <tr>
                      <td>{{ $page->id }}</td>
                      <td>{{ $page->title }}</td>
                      <td>{{ $page->updated_at }}</td>
                      <td>{{ $page->created_at }}</td>
					  <td><div class="btn-group"><a class="btn btn-primary" href='{{ route("page.show", $page->id) }}'><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="{{ route('admin.page.update', $page->id) }}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.page.delete', $page->id) }}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $pages->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection