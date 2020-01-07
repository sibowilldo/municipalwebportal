<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Password Reset Success | {{ config('app.name') }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/styles.bundle.css') }}" rel="stylesheet">
    <style>
       .m-widget7 .icon{
            font-size: 8em;
            text-align: center;
            display: block;
            margin: .5em;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-portlet m-portlet--skin-dark m-portlet--full-height rounded-sm">
                <div class="m-portlet__body">

                    <!--begin::Widget 7-->
                    <div class="m-widget7 m-widget7--skin-dark">
                        <i class="la la-check-circle icon m--font-success animated zoomIn" style=""></i>
                        <h1 class="animated fadeIn delay-1s text-uppercase">Password Reset Success </h1>
                        <div class="m-widget7__desc animated fadeInUp delay-1s">
                            What to do next...
                        </div>
                        <p></p>
                    </div>

                    <!--end::Widget 7-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->
</body>

<!-- end::Body -->
</html>
