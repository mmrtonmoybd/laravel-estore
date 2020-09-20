@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Category Update</h1>
          <p>Category Updating To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Categories</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.category.add') }}">Category update</a></li>
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
                <form action="{{ route('admin.category.update', ['id' => $category->id ]) }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Name" name="name" required value="{{ old('name') ? old('name') : $category->name }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Category Description</label>
                    <textarea class="form-control @error('info') is-invalid @enderror" id="exampleTextarea" rows="3" name="info" required>{{ old('info') ? old('info') : $category->description }}</textarea>
                  </div>
                
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection