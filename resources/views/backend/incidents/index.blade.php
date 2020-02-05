@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.index'))

@section('content')
    <!--Begin::Section-->
    <div class="row">
        @foreach($incidents as $incident)
            <div class="col-lg-4 col-md-6 col-sm-12">

                <!--begin:: Widgets-->
                <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                   REF: {{ $incident->reference }}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
                                        Quick Actions
                                    </a>
                                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 44.5px;"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">Reports</span>
                                                        </li>
                                                        @if(!count($incident->assignments))
                                                            <li class="m-nav__item">
                                                                <a href="{{ route('incidents.engineers',$incident->id) }}" class="m-nav__link">
                                                                    <i class="m-nav__link-icon la la-user"></i>
                                                                    <span class="m-nav__link-text">Assign Engineer</span>
                                                                </a>
                                                            </li> @endif
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.specialists', $incident->id) }}"  class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-user-secret"></i>
                                                                <span class="m-nav__link-text">Assign Specialist</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.engineers',$incident->id) }}"  class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-users"></i>
                                                                <span class="m-nav__link-text">Assign Working Group</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('incidents.edit', $incident->id) }}"  class="m-nav__link">
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
                        <div class="m-widget28">
                            <div class="m-widget28__pic m-portlet-fit--sides"></div>
                            <div class="m-widget28__container">

                                <!-- begin::Nav pills -->
                                <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#details-{{ $incident->uuid }}"><span><i class="fa flaticon-clipboard"></i></span><span>Details</span></a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#location-{{ $incident->uuid }}"><span><i class="fa flaticon-map-location"></i></span><span>Location Info</span></a>
                                    </li>
                                </ul>

                                <!-- end::Nav pills -->

                                <!-- begin::Tab Content -->
                                <div class="m-widget28__tab tab-content">
                                    <div id="details-{{ $incident->uuid }}" class="m-widget28__tab-container tab-pane active">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>Name</span>
                                                <span>{{ $incident->name }}</span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>Status</span>
                                                <span>{{ $incident->status->name }}</span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>Category</span>
                                                <span>{{ $incident->type->categories->first()?$incident->type->categories->first()->name:'' }}</span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>Type</span>
                                                <span>{{ $incident->type->name }}</span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>Logged at</span>
                                                <span>{{ $incident->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="location-{{ $incident->uuid }}" class="m-widget28__tab-container tab-pane fade">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>Location Description</span>
                                                <span>{{ $incident->location_description }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end::Tab Content -->
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets-->
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12">
                {{ $incidents->links() }}
        </div>
    </div>
@endsection

@section('css')
    <style>
        .m-datatable__lock--right{
            overflow: visible !important;
        }
        #map {
            width: 100%;
            height: 400px;
        }
        .mapControls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #searchMapInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
            top: 10px !important;
        }
        #searchMapInput:focus {
            border-color: #4d90fe;
        }
        .pac-container{
            z-index: 9999;}
    </style>
@stop


@section('js')
    <script src="{{ asset('js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap" async defer></script>
@endsection

@section('modals')

    <!--begin:: Log Incident Modal-->
    <div class="modal fade" id="log_incident_modal" tabindex="-1" role="dialog" aria-labelledby="logincident" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log Incident</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="log-incident" method="POST" action="{{ route('incidents.store') }}">
                        {{ csrf_field() }}
                        @include('backend.incidents._form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('log-incident').submit();">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

@stop
