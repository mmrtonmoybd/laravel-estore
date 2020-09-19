<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    @include('admin.partials.header')
@include('admin.partials.sidebar')
<main class="app-content">
@yield('content')
</main>
  <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    {!! Route::currentRouteName() == "admin.product.list" ? "<script type='text/javascript' src=" . asset("admin/js/plugins/bootstrap-notify.min.js") . "</script>" : "" !!}
    @if (Route::currentRouteName() == "admin.product.list" && session()->has('success'))
    {!! "<script type='text/javascript'>
      	$.notify({
      		title: '{session()->get('title')} : ',
      		message: '{session()->get('message')}',
      		icon: 'fa fa-check' 
      	},{
      		type: '{session()->get('type')}'
      	});</script>"
    !!}
    @endif
  </body>
  </html>