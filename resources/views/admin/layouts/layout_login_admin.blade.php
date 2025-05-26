@php
    $main_web = " - Desa Wisata Jawa Barat";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff">
    <meta name="robot" content="noindex; nofollow">
    <meta name="application-name" content="{{ getenv('APP_NAME','Desa Wisata Jawa Barat') }}">
    <meta name="app_url" content="{{ getenv('APP_URL','http://desawisata.apps/') }}">
    <meta name="rest_url" content="{{ getenv('REST_URL','http://desawisata.apps/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login {{ $main_web }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">

    <link rel="android-icon-icon" sizes="57x57" href="{{ asset('images/favicon/android-icon-57x57.png') }}">
    <link rel="android-icon-icon" sizes="60x60" href="{{ asset('images/favicon/android-icon-60x60.png') }}">
    <link rel="android-icon-icon" sizes="72x72" href="{{ asset('images/favicon/android-icon-72x72.png') }}">
    <link rel="android-icon-icon" sizes="76x76" href="{{ asset('images/favicon/android-icon-76x76.png') }}">
    <link rel="android-icon-icon" sizes="114x114" href="{{ asset('images/favicon/android-icon-114x114.png') }}">
    <link rel="android-icon-icon" sizes="120x120" href="{{ asset('images/favicon/android-icon-120x120.png') }}">
    <link rel="android-icon-icon" sizes="144x144" href="{{ asset('images/favicon/android-icon-144x144.png') }}">
    <link rel="android-icon-icon" sizes="152x152" href="{{ asset('images/favicon/android-icon-152x152.png') }}">
    <link rel="android-icon-icon" sizes="180x180" href="{{ asset('images/favicon/android-icon-180x180.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/mstile-144x144.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon-16x16.png') }}" type="image/x-icon" />
   <!-- Custom Theme Style -->
    <link href="{{ asset('styles/vendor-min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/devices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/custom.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('scripts/lib/formvalidation/css/formValidation.min.css') }}" rel="stylesheet"> --}}
    @yield('style')
    {{-- <link href="{{ asset('styles/desawisata_admin.css') }}" rel="stylesheet"> --}}
</head>
<body>
       @yield('content')
       <script src="{{ asset('scripts/jquery-3.3.1.js') }}"></script>
       <script src="{{ asset('scripts/bootstrap.min.js') }}"></script>
       <script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
       <script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
       <script src="{{ asset('scripts/lib/formvalidation/js/addons/reCaptcha2.min.js') }}"></script>
       <script src="{{ asset('scripts/js.cookie.min.js') }}"></script>
        @include('admin.partial.varscript')
        @include('sweetalert::cdn')
        @include('sweetalert::view')
       <script src="{{ asset('scripts/desawisata-admin.js') }}"></script>
       @yield('script')
</body>
</html>
