@php
    $main_web = "Desa Wisata Jawa Barat";
    $title_page = isset($title_page)?$title_page.' - '.$main_web:$main_web;
@endphp
<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="teddy dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="rest-url" content="{{ env("REST_URL","http://desawisata.apps/") }}" />
    <meta name="theme-color" content="#fff">
    <meta name="application-name">
    <title>{{ $title_page }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <!--[if (lte IE 8)&!(IEMobile)]>

    <script src="/assets/scripts/html5shiv.min.js"></script>
    <script src="/assets/scripts/respond.min.js"></script>

    [endif]-->


    <link href="{{ asset('styles/vendor-min.css')}}" rel="stylesheet">
    <link href="{{ asset('styles/main.min.css')}}" rel="stylesheet">
    <link href="{{ asset('styles/devices.min.css')}}" rel="stylesheet">
    <link href="{{ asset('styles/custom.min.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('css/custombaru.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('styles/dash-responsive.min.css')}}" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('styles/desawisata_admin.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('css/desawisata-admin.css')}}" rel="stylesheet"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/styles.css')}}"> --}}
   <script>
       var base_url = '{{ env("APP_URL") }}';
       var rest_url = '{{ env("REST_URL","http://desawisata.apps/api/") }}';
   </script>

</head>
