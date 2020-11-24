@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Page Update</h1>
          <p>Page Adding To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.page.update', $page->id) }}">Page Update</a></li>
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
                <form action="{{ route('admin.page.update', $page->id) }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Page Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Page Title" name="title" required value="{{ old('title') ? old('title') : $page->title }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Page Description</label>
                    <textarea class="form-control @error('info') is-invalid @enderror" id="summernote" rows="5" name="info">{{ old('info') ? old('info') : $page->content }}</textarea>
					<script>
               new SimpleMDE({
		element: document.getElementById("summernote"),
		spellChecker: false,
	});
</script>
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