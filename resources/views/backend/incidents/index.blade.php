@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.index'))

@section('content')
    <!--Begin::Section-->
    <div class="row">
        @foreach($incidents as $incident)

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    <a href="{{ route('incidents.show', $incident->id) }}"># {{ $incident->id }} - {{ $incident->reference }}</a>
                                </h3>
                            </div>
                        </div><div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                @if(!count($incident->assignments))
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Assign Engineer" href="{{ route('incidents.engineers',$incident->id) }}" class="m-portlet__nav-link btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="la la-user"></i>
                                    </a>
                                </li> @endif
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Assign Specialist" href="{{ route('incidents.specialists', $incident->id) }}" class="m-portlet__nav-link btn btn-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="la la-user-secret"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Assign Working Group" href="{{ route('incidents.engineers',$incident->id) }}" class="m-portlet__nav-link btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="la la-users"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Edit Details" href="{{ route('incidents.edit', $incident->id) }}" class="m-portlet__nav-link btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="la la-edit"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
                                                    Name
												</span>
                                <span class="m-widget13__text m-widget13__text-bolder">
													{{ $incident->name }}
												</span>
                            </div>
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Status:
												</span>
                                <span class="m-widget13__text m-widget13__number-bolder m--font-{{ $incident->status->state_color }}">
													{{ $incident->status->name }}
												</span>
                            </div>
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Category:
												</span>
                                <span class="m-widget13__text m-widget13__text-bolder">
													{{ $incident->type->categories->first()?$incident->type->categories->first()->name:'' }}
												</span>
                            </div>
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Type:
												</span>
                                <span class="m-widget13__text">
													{{ $incident->type->name }}
												</span>
                            </div>
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Logged:
												</span>
                                <span class="m-widget13__text m-widget13">
													{{ $incident->created_at->diffForHumans() }}. {{ $incident->created_at->format('M, d Y @ h:m:s') }}
												</span>
                            </div>
                            <div class="m-widget13__item">
												<span class="m-widget13__desc m--align-right">
													Location:
												</span>
                                <span class="m-widget13__text">
                                    <span class="m--font-bold m--font-brand">{{ $incident->longitude }}, {{ $incident->latitude }} </span>
													<br>
                                                    {{ $incident->location_description }}
												</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
