@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Settings</h1>
          <p>Settings For {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item">Settings</li>
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
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
                <form action="{{ route('admin.setting.list') }}" method="POST">
                @csrf
				<div class="form-group">
                    <label for="exampleInputEmail1">Home(SEO) Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Title" name="title" required value="{{ old('title') ? old('title') : $title }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Home(SEO) Description</label>
                    <textarea class="form-control @error('info') is-invalid @enderror" id="exampleTextarea" rows="3" name="info" required>{{ old('info') ? old('info') : $info }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Item Per Page</label>
                    <input class="form-control @error('page') is-invalid @enderror" id="exampleInputName" type="number" aria-describedby="NameHelp" placeholder="Enter Item Per Page" name="item" required value="{{ old('page') ? old('page') : $item }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Item Per Column</label>
                    <input class="form-control @error('column') is-invalid @enderror" id="exampleInputName" type="number" aria-describedby="NameHelp" placeholder="Enter Item Per Column" name="column" required value="{{ old('column') ? old('column') : $column }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stripe Secret Key</label>
                    <input class="form-control @error('secret') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Stripe Secret Key" name="secret" required value="{{ old('secret') ? old('secret') : $secret }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stripe Public Key</label>
                    <input class="form-control @error('public') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Stripe Public Key" name="public" required value="{{ old('public') ? old('public') : $public }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stripe Currency</label>
                    <input class="form-control @error('currency') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Stripe Currency" name="currency" required value="{{ old('currency') ? old('currency') : $currency }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">VAT(%)</label>
                    <input class="form-control @error('vat') is-invalid @enderror" id="exampleInputName" type="number" aria-describedby="NameHelp" placeholder="Enter VAT" name="vat" required value="{{ old('vat') ? old('vat') : $vat }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Meta Key</label>
                    <input class="form-control @error('google') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Key" name="google" required value="{{ old('google') ? old('google') : $google }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bing Meta Key</label>
                    <input class="form-control @error('bing') is-invalid @enderror" id="exampleInputName" type="text" aria-describedby="NameHelp" placeholder="Enter Bing Key" name="bing" required value="{{ old('bing') ? old('bing') : $bing }}">
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