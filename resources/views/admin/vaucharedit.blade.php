@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-percent"></i> Create Vauchar</h1>
          <p>Vauchar Adding To {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Vauchars</li>
          <li class="breadcrumb-item"><a href="{{ route('admin.vauchar.add') }}">Create Vauchar</a></li>
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
                <form action="{{ route('admin.vauchar.update', ['id' => $vauchar->id,]) }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Vauchar Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="exampleInputTitle" type="text" aria-describedby="TitleHelp" placeholder="Enter Title" name="title" required value="{{ old('title') ? old('title') : $vauchar->title }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Vauchar Type</label>
                    <select class="form-control @error('type') is-invalid @enderror" id="exampleSelect1" name="type" required>
                    <option value="product" @if ($vauchar->type == 'product') selected @endif>Product</option>
                    <option value="user" @if ($vauchar->type == 'user') selected @endif>User</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Vauchar User/Product</label>
                    <input class="form-control @error('id') is-invalid @enderror" id="exampleInputQty1" type="text" placeholder="Enter ID" name="id" required value="{{ old('id') ? old('id') : $vauchar->id }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Vauchar Quantity</label>
                    <input class="form-control @error('quantity') is-invalid @enderror" id="exampleInputQty1" type="number" placeholder="Quantity" name="quantity" required value="{{ old('quantity') ? old('quantity') : $vauchar->quantity }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Vauchar Code</label>
                    <input class="form-control @error('code') is-invalid @enderror" id="exampleInputQty1" type="text" placeholder="Code" name="code" required value="{{ old('code') ? old('code') : $vauchar->code }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Vauchar Value Type</label>
                    <select class="form-control @error('vtype') is-invalid @enderror" id="exampleSelect1" name="vtype" required>
                    <option value="percent" @if ($vauchar->vtype == 'percent') selected @endif>Percentage</option>
                    <option value="money" @if ($vauchar->vtype == 'money') selected @endif>Money</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputqty1">Vauchar Vaule</label>
                    <input class="form-control @error('value') is-invalid @enderror" id="exampleInputQty1" type="text" placeholder="Value" name="value" required value="{{ old('value') ? old('value') : $vauchar->vaule }}">
                  </div>
					  <div class="tile-footer">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
                </form>
              </div>
            </div>
			
			
          </div>
        </div>
      </div>
@endsection