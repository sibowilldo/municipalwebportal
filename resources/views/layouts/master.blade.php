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


    <link href=" {{ mix('css/vendors.css') }}" rel="stylesheet">
    <link href=" {{ mix('css/styles.css') }}" rel="stylesheet">
    <link href=" {{ asset('assets/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet">


    @yield('css')
</head>


<!-- begin::Body -->
<body style="background-image: url({{ asset('assets/img/durban-beach.jpg') }})" class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">

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
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- begin::Header -->
    @include('layouts.sections.header')
    <!-- end::Header -->
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">@yield('title')</h3>
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
    @include('layouts.sections.quick-sidebar')
<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!-- begin::Quick Nav -->
@include('layouts.sections.quick-nav')

<script type="text/javascript" src="/js/mandatory.js"></script>
<script type="text/javascript" src="/js/vendors.js"></script>
<script type="text/javascript" src="/js/scripts.bundle.js"></script>
<script type="text/javascript" src="/assets/fullcalendar/fullcalendar.js"></script>
<script type="text/javascript" src="/js/dashboard.js"></script>

@yield('js')
<!-- begin::Page Loader -->
<script>
    $(window).on('load', function() {
        $('body').removeClass('m-page--loading');
    });
</script>

{{--begin::Modals--}}
@yield('modals')
{{--end::Modals--}}

@include('flash::message')
</body>
</html>
