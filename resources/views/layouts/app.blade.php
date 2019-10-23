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
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="/images/favicon.ico">
</head>
<body>
    <div id="app">
      <router-view></router-view>
    </div>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vue-material"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
