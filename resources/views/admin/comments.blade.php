@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Comments</h1>
          <p>Display All Comments</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Comments</li>
        </ul>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
		  <div class="tile-title-w-btn">
              <h3 class="title">All Comments</h3>
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
                    <option onClick="window.location = '{{ route("admin.comment.list") }}'">Latest(Default)</option>
                    <option onClick="window.location = '{{ route("admin.comment.list") }}?order=older'">Oldest</option>
                  </select></label>
                  </div>
                </div>
                </div>
                  <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Comment/Product ID</th>
                      <th>Type</th>
                      <th>Content</th>
                      <th>User/Admin</th>
                      <th>Updated</th>
                      <th>Created</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($comments as $comment)
                  <tr>
                      <td>{{ $comment->id }}</td>
                      <td>{{ $comment->commentable_id }}</td>       
                      <td>@if ($comment->commentable_type == 'App\Comment') {{ "Reply" }} @else {{ "Comment" }} @endif</td>
                      <td>{{ $comment->comment }}</td>
                      <td>@if ($comment->commented_type == 'App\Admin') {{ \App\Comment::adminCom($comment->commented_id)->name . "Admin"}} @else {{ \App\Comment::user($comment->commented_id)->name }} @endif</td>
                      <td>{{ $comment->updated_at }}</td>
                      <td>{{ $comment->created_at }}</td>
					  <td><div class="btn-group">@if ($comment->commentable_type != 'App\Comment')<a class="btn btn-primary" href='{{ url("product/{$comment->commentable_id}")}}'><i class="fa fa-lg fa-eye"></i></a>@endif<a class="btn btn-primary" href="{{ route('admin.comment.update', ['id' => $comment->id])}}"><i class="fa fa-lg fa-edit"></i></a><a class="btn btn-primary" href="{{ route('admin.comment.delete', ['id' => $comment->id])}}"><i class="fa fa-lg fa-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $comments->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection