@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.show', $incident))

@section('content')

    <div class="row">

            <div class="col-xl-6 offset-xl-3">

                <!--begin:: Widgets/Activity-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    {{ title_case($incident->name) }}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
                                        <i class="fa fa-genderless m--font-light"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 14.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">Quick Actions</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">Assign Engineer</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">Assign Working Group</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.edit', $incident->id) }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-edit"></i>
                                                                <span class="m-nav__link-text">Edit Details</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget17">
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides" style="margin-top: -70px;">
                                <div class="" style="height:400px;">
                                    <div id="gmap" style="height: 400px; width: 100%;"></div>
                                    <input type="hidden" id="latitude" value="{{ $incident->latitude }}">
                                    <input type="hidden" id="longitude" value="{{ $incident->longitude }}">
                                </div>
                            </div>
                            <div class="m-widget17__stats">
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-calendar-2 m--font-brand"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Reported
														</span>
                                        <span class="m-widget17__desc">
															{{ $incident->created_at->diffForHumans() }}
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-analytics m--font-info"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Status
														</span>
                                        <span class="m-widget17__desc">
															{{ $incident->status->name }}
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-refresh m--font-success"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Last Updated
														</span>
                                        <span class="m-widget17__desc">
															{{ $incident->updated_at->diffForHumans() }}
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-time m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Arrived
														</span>
                                        <span class="m-widget17__desc">
															34 Upgraded Boxes
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget17__stats mt-5">
                                <h5 class="mb-3">Incident History</h5>
                                <table class="table m-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Message</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $incident->created_at->format('d M Y h:i:s') }}</td>
                                        <td>Incident Reported</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::now()->addMinute(1) }}</td>
                                        <td>Some Message</td>
                                        <td>Something else here</td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::now()->addHours(1) }}</td>
                                        <td>Some Message</td>
                                        <td>Something else here</td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::now()->addWeek(1) }}</td>
                                        <td>Some Message</td>
                                        <td>Something else here</td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::now()->addMonths(1) }}</td>
                                        <td>Some Message</td>
                                        <td>Something else here</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Activity-->
            </div>
    </div>

@endsection

@section('css')
    <style>
        .m-portlet__head{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#000000+0,000000+100&0.65+0,0+100;Neutral+Density */
            background: -moz-linear-gradient(top,  rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
        }
    </style>
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap" async defer></script>
    <script>
        // Initialize and add the map
        function initMap() {
            // Get The location
            var lat = $('#latitude').val(), long = $('#longitude').val();
            var loc = {lat: parseFloat(lat), lng: parseFloat(long)};

            console.log(loc);
            // The map, centered at the Location
            var map = new google.maps.Map(
                document.getElementById('gmap'), {zoom: 15, center: loc,
                    disableDefaultUI: true,
                    gestureHandling: 'cooperative'});
            // The marker, positioned at the Location
            var marker = new google.maps.Marker({position: loc, map: map});
        }

    </script>
@endsection