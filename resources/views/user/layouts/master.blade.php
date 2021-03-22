<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('title')
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/main.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    @include('user.components.header')
    @yield('content')
    @include('user.components.footer')
</body>
    <script src="{{ asset('asset/js/jquery.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('asset/js/price-range.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script src="{{ asset('asset/js/html5shiv.js') }}"></script>
    @yield('js')
</html>
