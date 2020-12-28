<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} Admin Lock Screen</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="lockscreen-content">
      <div class="logo">
        <h1>Lock Screen</h1>
      </div>
      <div class="lock-box"><img class="rounded-circle user-image" src="{{ (!is_null(Auth::guard('admin')->user()->adminInfo->image)) ? asset(Auth::guard('admin')->user()->adminInfo->image) : 'https://st2.depositphotos.com/1006318/5909/v/950/depositphotos_59095529-stock-illustration-profile-icon-male-avatar.jpg' }}" width="80" height="80">
        <h4 class="text-center user-name">{{ Auth::guard('admin')->user()->name }}</h4>
        <p class="text-center text-muted">Account Locked</p>
        <form class="unlock-form" action="{{ route('admin.password.confirm') }}" method="POST">
            @csrf
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autofocus autocomplete="current-password">
            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg"></i>UNLOCK </button>
          </div>
        </form>
        <p><a href="{{ route('admin.logout') }}">Not {{ Auth::guard('admin')->user()->name }} ? Logout Here.</a></p>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>
  </body>
</html>