@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.show', $incident))

@section('content')

    <div class="row">

            <div class="col-xl-6 offset-xl-3">

                <!--begin:: Widgets/Activity-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height  m-portlet--rounded-force">
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
                                                        @if(!count($incident->assignments))
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.engineers', $incident->id) }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-user"></i>
                                                                <span class="m-nav__link-text">Assign Engineer</span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.specialists', $incident->id) }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-user-secret"></i>
                                                                <span class="m-nav__link-text">Assign Specialist</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-users"></i>
                                                                <span class="m-nav__link-text">Assign Working Group</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.edit', $incident->id) }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-edit"></i>
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
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides" style="margin-top: -75px;">
                                <div style="height:400px;" class="m--bg-info">
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
															<i class="flaticon-app m--font-info"></i>
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
															<i class="flaticon-folder-1 m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Category
														</span>
                                        <span class="m-widget17__desc">
															{{ $incident->type()->first()->categories()->first()->name}}
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget17__stats mt-5">
                                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#incident-information" role="tab">Information</a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#incident-attachments" role="tab">Attachments</a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#incident-log" role="tab">Incident Logs</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="incident-information" role="tabpanel">
                                        <h6 class="font-weight-bold">Reference</h6>
                                        <p>{{ $incident->reference }}</p>
                                        <div class="m-separator--dashed m-separator"></div>
                                        <h6 class="font-weight-bold">Map Coordinates</h6>
                                        <p class="m--font-primary ">{{ $incident->longitude }}, {{ $incident->latitude }} </p>
                                        <div class="m-separator--dashed m-separator"></div>
                                        <h6 class="font-weight-bold">Location Description</h6>
                                        <p>{{ $incident->location_description }}</p>
                                        <div class="m-separator--dashed m-separator"></div>
                                        <h6 class="font-weight-bold">Description</h6>
                                        <p>{{ $incident->description }}</p>
                                    </div>
                                    <div class="tab-pane" id="incident-attachments" role="tabpanel">
                                        <p class="text-center">
                                            <i class="flaticon-attachment"></i> <br>
                                            No Attachments Found!</p>
                                    </div>
                                    <div class="tab-pane" id="incident-log" role="tabpanel">
                                        <div class="m-scrollable" data-scrollable="true" style="height: 500px">
                                            <div class="m-list-timeline">
                                                <div class="m-list-timeline__items">
                                                    @foreach($histories as $history)
                                                        <div class="m-list-timeline__item">
                                                            <span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
                                                            <span class="m-list-timeline__text"> {{ $history->update_reason }} by <span class="font-weight-bolder m--font-danger">{{ $history->user->fullname }}</span> </span>
                                                            <span class="m-list-timeline__time">  {{ $history->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    @endforeach
                                                    <div class="m-list-timeline__item">
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                        <span class="m-list-timeline__text">Incident logged</span>
                                                        <span class="m-list-timeline__time">{{ $incident->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        span.m-list-timeline__time{
            width: 100px !important;
        }
        .tab-content{
            border: 4px solid #f7f7fa;
            padding: 20px;
        }
        .m-portlet__head{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#000000+0,000000+100&0.65+0,0+100;Neutral+Density */
            background: -moz-linear-gradient(top,  rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  rgba(0,0,0,0.4) 0%,rgba(0,0,0,0) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  rgba(0,0,0,0.4) 0%,rgba(0,0,0,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
        }
    </style>
@endsection

@section('js')
{{--    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap" async defer></script>--}}
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
