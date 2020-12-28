@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Optimize</h1>
          <p>Optimize {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.optimize.index') }}">Optimize</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              @if(session()->has('successo'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('successo') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
            <div class="tile-body"><p>Optimize {{ config('app.name') }}, Optimize can speed up your application.
                All are optimize(router, config, view, cache, event and many..).</p>
                <a href="{{ route('admin.optimize.add') }}"><button class="btn btn-primary" type="button">Optimize</button></a>
            </div>
          </div>
          <div class="tile">
              @if(session()->has('successoc'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('successoc') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
            <div class="tile-body"><p>Optimize clear {{ config('app.name') }}, Optimize clear can slow down your application.
                All are optimize(router, config, view, cache, event and many..) cleared!.</p>
                <a href="{{ route('admin.optimize.clear') }}"><button class="btn btn-danger" type="button">Optimize cleared</button></a>
            </div>
          </div>
        </div>
      </div>
@endsection