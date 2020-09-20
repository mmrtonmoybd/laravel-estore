@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Product Update</h1>
          <p>Product Update To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.product.add') }}">Product Update</a></li>
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
                <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Product Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="exampleInputTitle" type="text" aria-describedby="TitleHelp" placeholder="Enter Title" name="title" required value="{{ old('title') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Product Quantity</label>
                    <input class="form-control @error('quantity') is-invalid @enderror" id="exampleInputQty1" type="number" placeholder="Quantity" name="quantity" required value="{{ old('quantity') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Product Category</label>
                    <select class="form-control @error('category') is-invalid @enderror" id="exampleSelect1" name="category" required>
                    @foreach ($categorys as $category)
                      <option value="{{ $category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Product Description</label>
                    <textarea class="form-control @error('info') is-invalid @enderror" id="exampleTextarea" rows="3" name="info" required>{{ old('info') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Product Thumbnail</label>
                    <input class="form-control-file @error('thumbnail') is-invalid @enderror" id="exampleInputFile" type="file" aria-describedby="fileHelp" name="thumbnail" value="{{ old('thumbnail') }}" required>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputqty1">Product Discounds</label>
                    <input class="form-control @error('discounds') is-invalid @enderror" id="exampleInputDiscounds1" type="number" placeholder="Discounds" name="discounds" value="{{ old('discounds') }}" required>
                  </div>
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Product Price (in dollars)</label>
                      <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input class="form-control @error('price') is-invalid @enderror" id="exampleInputAmount" type="number" placeholder="Amount" name="price" required value="{{ old('price') }}">
                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
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