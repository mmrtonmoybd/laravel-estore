@extends('layouts.admin')
@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      <p>Admin Dashboard For {{ config('app.name') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Users</h4>
              <p><b>{{ $users }}</b></p>
            </div>
          </div>
        </div>
        @can('isAdmin')
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Admins</h4>
              <p><b>{{ $admins }}</b></p>
            </div>
          </div>
        </div>
        @endcan
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-product-hunt fa-3x"></i>
            <div class="info">
              <h4>Products</h4>
              <p><b>{{ $products }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-credit-card fa-3x"></i>
            <div class="info">
              <h4>Payments</h4>
              <p><b>{{ $payments }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-sellsy fa-3x"></i>
            <div class="info">
              <h4>Sells</h4>
              <p><b>{{ $sells }}</b></p>
            </div>
          </div>
        </div>
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-star fa-3x"></i>
<div class="info">
<h4>Categories</h4>
<p><b>{{ $category }}</b></p>
</div>
                                                                </div>
        @can('isAdmin')
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h4>Incomes</h4>
              <p><b>${{ $incomes }}</b></p>
            </div>
          </div>
        </div>
                <div class="col-md-6 col-lg-3">
                          <div class="widget-small info coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                                      <div class="info">
                                                    <h4>Stars</h4>
                                                                  <p><b>{{ $rating }}</b></p>
                                      </div>
                                      </div>
                                      </div>
                                                                
        @endcan
      </div>
@endsection