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
</head>

<!-- end::Head -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(/assets/img/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid pt-2	m-login__wrapper d-flex flex-column align-items-center justify-content-center">
            <div class="m-login__container">
                <div class="m-login__logo ">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div style="width:100px;height:100px" class="lottie"
                             data-animation-path="/assets/lottie-animations/Success.json"
                             data-anim-loop="false"
                             data-name="success"></div>
                    </div>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">Your password was reset successfully.</h3>
                    </div>
                </div>
                <div class="m-login__account">
                    <span class="m-login__account-msg">
                        You can now use your new password to sign-in to the app.
                    </span>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.6.8/lottie.min.js" integrity="sha256-HlqBFI4b3mzFNE97JQcgI/uhJvHBI5czBqfVtEeA1Hg=" crossorigin="anonymous"></script>
</body>
</html>
