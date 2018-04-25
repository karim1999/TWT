<!DOCTYPE html>
<html class=''>
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!------ Include the above in your HEAD tag ---------->

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body>

<div id="frame">
    <leftArea></leftArea>
    <router-view></router-view>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
@include ('footer')
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>