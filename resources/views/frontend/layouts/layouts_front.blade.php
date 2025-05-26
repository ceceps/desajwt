@php $main_web = "Desa Wisata Jawa Barat"; $title_page = isset($title_page)?$title_page.' - '.$main_web:$main_web;
@endphp
<!doctype html>
<html class="front" lang="id_ID">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title_page }}</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#fff">
    <meta name="author" content="Destinasi Pariwisata, Dinas Pariwisata dan Kebudayaan Jawa Barat">
    <meta name="developer" content="http://www.konsultanblog.com">
    <meta name="msvalidate.01" content="A93BCF5E851A6D87F94341A04AFE6D7A" />
    <meta name="google-site-verification" content="NF2FKysY6iL8pGTrBYT3liBhoRTA7mQhRPFas0ixN14" />
    <meta name="application-name" content="{{ env('APP_NAME','Desa Wisata Jawa Barat') }}">
    <meta name="keywords" content="{!! isset($keywords)?$keywords:env('APP_NAME','Desa Wisata Jawa Barat') !!}">
    <meta name="description" content="{!! isset($description)?$description:env('APP_NAME','Desa Wisata Jawa Barat') !!}">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title_page }}" />
    <meta property="og:description" content="{!! isset($description)?$description:env('APP_NAME','Desa Wisata Jawa Barat') !!}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME','Desa Wisata Jawa Barat') }}" />
    <meta name="twitter:card" content="{{ isset($fitur_img)?asset($fitur_img):asset('images/favicon/apple-icon-180x180.png') }}" />
    <meta name="twitter:description" content="{!! isset($description)?$description:env('APP_NAME','Desa Wisata Jawa Barat') !!}" />
    <meta name="twitter:title" content="{{ $title_page }}" />
    <meta name="twitter:image" content="{{ asset('images/favicon/apple-icon-180x180.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">

    <!--[if (lte IE 8)&!(IEMobile)]-->

    <!--<script src="/assets/scripts/html5shiv.min.js"></script>
  <script src="/assets/scripts/respond.min.js"></script>-->

    <!--[endif]-->


    <link href="{{ asset('styles/vendor-min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/devices.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/custom.css') }}" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('styles/desawisata-front.css') }}" rel="stylesheet">

    <script>

    </script>
</head>

<body>
    <main class="main-wrap">
        @include('frontend.partial.header')
        <div class="main-content">
            @yield('content')
        </div>
        @include('frontend.partial.footer')
        @include('frontend.partial.mobile_menu')
        @include('frontend.partial.chat_fab')
    </main>

    <script src="{{ asset('scripts/lib/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('scripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/popper.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('scripts/lib/select2.full.js') }}"></script>
    <script src="{{ asset('scripts/js.cookie.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/owl.carousel.js') }}"></script>
    <script src="{{ asset('scripts/lib/front.js') }}"></script>
    @yield('script')

</body>

</html>
