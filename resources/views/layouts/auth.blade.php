<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>Login | {{ config('app.name') }}</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700|Anton:400">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('assets/v614/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/v614/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ mix('assets/v614/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/v614/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/v614/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/v614/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/v614/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside">
                <div class="background-overlay" style=""></div>
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img src="/assets/img/ethekwini-logo.png" width="100px">
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver text-center">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h1 class="kt-login__title text-lg-center text-white text-uppercase"  style="width: 100%; font-family: anton; font-size:4em">{{ config('app.name')  }}</h1>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div class="kt-login__info">
                        <div class="kt-login__copyright">
                            <a href="#" class="kt-link">&copy {{ \Carbon\Carbon::now()->year }} {{ config('app.name') }}</a>
                        </div>
                        <div class="kt-login__menu">
                            <a href="#" class="kt-link">Privacy</a>
                            <a href="#" class="kt-link">Legal</a>
                            <a href="#" class="kt-link">Contact</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                @yield('content')
            </div>

            <!--end::Content-->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
{{ Html::script('assets/v614/plugins/global/plugins.bundle.js')}}
{{ Html::script('assets/v614/js/scripts.bundle.js')}}
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/pages/custom/login/login-1.js" type="text/javascript"></script>

<style>
    .kt-login__aside{
        position: relative;
        background-image: url('/2706525-02.png');
    }
    .kt-login__aside .kt-grid__item{
        z-index: 1;
    }
    .background-overlay{
        position: absolute;
        background: #33338Bdb;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>