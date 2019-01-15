<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Portal | {{ config('app.name') }}</title>
    <link href=" {{ mix('css/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('assets/fonts/fonts.css') }}" rel="stylesheet">
</head>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div id="app" class="m-grid m-grid--hor m-grid--root m-page">
        <router-view></router-view>
    </div>
    <script src="/js/bundle.min.js"></script>
</body> 
</html>
