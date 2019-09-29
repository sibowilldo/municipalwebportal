<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{ config('app.name') }}</title>

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/styles.bundle.css') }}" rel="stylesheet">
    <link href=" {{ asset('assets/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet">

    @yield('css')

    {{ Html::script('js/manifest.js') }}
    {{ Html::script('js/vendor.js') }}
</head>


<!-- begin::Body -->
<body class="m-page--fluid m--skin-light  m-page--loading m-page--loading-enabled  m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin::Page loader -->
<div class="m-page-loader m-page-loader--base">
    <div class="m-blockui">
        <span>Please wait...</span>
        <span>
            <div class="m-loader m-loader--brand"></div>
        </span>
    </div>
</div>

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="app">

    <!-- begin::Header -->
    @include('layouts.sections.header')
    <!-- end::Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            @include('layouts.sections.m-header__bottom')
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">@yield('title')</h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="#" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            @yield('breadcrumbs')
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">

                <!-- begin::Body -->
                @yield('content')
                <!-- end::Body -->
            </div>
        </div>
    </div>
    <!-- begin::Footer -->
    @include('layouts.sections.footer')
    <!-- end::Footer -->
</div>

<!-- end:: Page -->

<!-- begin::Quick Sidebar -->
    {{--@include('layouts.sections.quick-sidebar')--}}
<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<div id="token_div" style="display: none;">
    <h4>Instance ID Token</h4>
    <p id="token" style="word-break: break-all;"></p>
    <button class="btn btn-danger btn-sm m-btn--pill m-btn m-btn--air"
            onclick="deleteToken()">Delete Token</button>
</div>
<!-- div to display the UI to allow the request for permission to
     notify the user. This is shown if the app has not yet been
     granted permission to notify. -->
<div id="permission_div" style="display: none;">
    <h4>Needs Permission</h4>
    <p id="token"></p>
    <button class="btn btn-primary btn-sm m-btn--pill m-btn m-btn--air"
            onclick="requestPermission()">Request Permission</button>
</div>
<!-- div to display messages received by this app. -->
<div id="messages"></div>

<!-- end::Scroll Top -->

<!-- begin::Quick Nav -->
{{--@include('layouts.sections.quick-nav')--}}

{{ Html::script('js/app.js') }}

{{ Html::script('js/mandatory.js') }}
{{ Html::script('js/vendors.js') }}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
{{ Html::script('js/scripts.bundle.js') }}
{{ Html::script('assets/fullcalendar/fullcalendar.js') }}
{{ Html::script('js/dashboard.js') }}

{{--<script>--}}

{{--    // Enable pusher logging - don't include this in production--}}
{{--    Pusher.logToConsole = true;--}}

{{--    var pusher = new Pusher('2de195b72f4553a64115', {--}}
{{--        cluster: 'ap2',--}}
{{--        forceTLS: false--}}
{{--    });--}}

{{--    var channel = pusher.subscribe('incidentMessages');--}}
{{--    channel.bind('eIncidentMessages', function(data) {--}}
{{--        toastr.info(JSON.stringify(data.incident.name));--}}
{{--    }).bind('pusher:subscription_succeeded', function(data) {--}}
{{--        console.log('successfully subscribed!');--}}
{{--    });--}}
{{--</script>--}}

{{--begin::page scripts--}}
@yield('js')
{{--end::page scripts--}}

<!-- begin::Page Loader -->
<script>
    $(window).on('load', function() {
        $('body').removeClass('m-page--loading');
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

{{--begin::Modals--}}
@yield('modals')
{{--end::Modals--}}

@include('flash::message')

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBXdTNczFlvE1koz3HYZWSWDFyJU10vCFM",
        authDomain: "nomasi-solutions-tp.firebaseapp.com",
        databaseURL: "https://nomasi-solutions-tp.firebaseio.com",
        projectId: "nomasi-solutions-tp",
        storageBucket: "",
        messagingSenderId: "296694516593",
        appId: "1:296694516593:web:08611e56574d6cc6bc44d0"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging()
    messaging.requestPermission()
        .then(function(){
            console.info('Notification Permissions','We have them');
            return messaging.getToken()
        })
        .then(function(token){
            console.log(token)
        })
        .catch(function (err) {
            console.error('Notification Permission Error', err)
        })

    messaging.onMessage(function(payload){
        console.info(payload);
    });
</script>


</body>
</html>
