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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="/css/vue-material.min.css">
    <link rel="stylesheet" href="/css/default.css">
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="/images/vue-logo.png">
</head>
<body>
    <div id="app">
      <router-view></router-view>
    </div>
    <script src="/js/vue.js"></script>
    <script src="/js/vue-material.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
