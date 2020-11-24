@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Comment Update</h1>
          <p>Comment Updating To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Comment</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.comment.update', ['id' => $comment->id]) }}">Comment update</a></li>
        </ul>
      </div>
	  
	  <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">
              @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
                <form action="{{ route('admin.comment.update', ['id' => $comment->id ]) }}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="exampleTextarea">Comment / Reply Content</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="exampleTextarea" rows="3" name="comment" required>{{ old('comment') ? old('comment') : $comment->comment }}</textarea>
                  </div>
                
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection