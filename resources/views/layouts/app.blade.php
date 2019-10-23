<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=1400, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="masterdata-version">
    @if (Auth::check())
        <meta name="authenticated" content="1">
    @endif

    <title>{{ config('app.name', 'bitCastle') }}</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="/images/favicon.ico">
</head>
<body>
    <div id="app">
      <router-view></router-view>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
