<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="mobile-web-app-capable" content="yes">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>RDU-Community | Loading ...</title>

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<noscript>If you're seeing this message, that means <strong>JavaScript has been disabled on your browser</strong>, please <strong>enable JS</strong> to make this app work.</noscript>
<div id="root"></div>
<div id="version" style="display: none;">{!! $hash !!}</div>
<!-- Scripts -->
<script src="{{mix('/js/main.js')}}"></script>
</body>
</html>
