<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'E-COMMERCE Make By Moshiur' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('partials.navbar')
  <!-- Page Content -->

        <main class="py-4">
		<div class="container">
            @yield('content')
			</div>
        </main>
    </div>
	<script src="{{ asset('jquery/jquery.min.js') }}"></script>
</body>
</html>
