@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    @include('widgets.dashboard.incidents-at-a-glance')

    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Incidents') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                @include('layouts.form-errors')
                    <!--begin: Datatable -->
                    <div class="m_datatable">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label>{{ __('Status:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_status">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($statues as $status)
                                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">{{ __('Type:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_type">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <button type="button" data-toggle="modal" data-target="#log_incident_modal" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Log Incident') }}</span>
                                    </span>
                                    </button>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>

                        <!--end: Search Form -->
                        <table class="m_datatable" id="incidents">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Reference">{{ __('Reference') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="LoggedAt">{{ __('Logged At') }}</th>
                                <th data-field="Type">{{ __('Type') }}</th>
                                <th data-field="Status">{{ __('Status') }}</th>
                                <th data-field="Location">{{ __('Location') }}</th>
                                <th data-field="SuburbID">{{ __('Suburb') }}</th>
                                {{--<th data-field="User">{{ __('User') }}</th>--}}
                                <th data-field="Actions" class="text-center">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incidents as $incident)
                            <tr>
                                <td>{{ $incident->id }}</td>
                                <td>{{ $incident->reference }}</td>
                                <td>{{ $incident->name }}</td>
                                <td>{{ $incident->created_at }}</td>
                                <td>{{ $incident->type->id }}</td>
                                <td>{{ $incident->status->id }}</td>
                                <td>{{ $incident->longitude }}, {{ $incident->latitude }}</td>
                                <td>{{ $incident->suburb_id }}</td>
                                {{--<td>{{ count($incident->users) ? $incident->users[0]['firstname'] : '' }}</td>--}}
                                <td>
                                    @if(!count($incident->assignments))
                                    <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" href="/engineers/{{$incident->id}}/list"  data-toggle="tooltip" data-placement="top" title="Assign Engineer"><i class="fa 	fa-wrench"></i></a>
                                    @endif
                                    <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" href="/group/{{$incident->id}}/list"  data-toggle="tooltip" data-placement="top" title="Assign Working Group"><i class="flaticon-network"></i></a>
                                    <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" href="/incidents/{{$incident->id}}/edit" data-toggle="tooltip" data-placement="top"  title="Edit Details"><i class="la la-edit"></i></a>
                                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="tooltip" data-placement="top" title="Close Incident">
                                        <i class="flaticon-interface-5"></i>
                                    </a>


                                </td>
                                {{-- <td></td> --}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--end: Datatable -->
                </div>
            </div>
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

    {{ Html::script('js/project-mdatatable.js') }}
    <script>
        var LoadTypes = function(){
            var types = function(){
                $('select[name="category_id"]').on('change', function() {
                    var categoryId = $(this).val();
                    if(categoryId) {
                        $.ajax({
                            url: '/json/types/'+categoryId,
                            type:"GET",
                            dataType:"json",
                            beforeSend: function(){
                                $('#loader').css("visibility", "visible");
                            },
                            success:function(data) {
                                $('select[name="type_id"]').empty();
                                $.each(data.data, function(key, value){
                                    $('select[name="type_id"]').append('<option value="'+ key +'">' + value + '</option>');

                                });
                            },
                            complete: function(){
                                $('#loader').css("visibility", "hidden");
                            }
                        });
                    } else {
                        $('select[name="type_id"]').empty();
                    }
                })
            }

            return {
                init: function(){
                    types()
                }
            }
        }();
        /**
         * Function REQUIRED!
         *
         *
        */
        const TableMethods = function(){
            return{
                init:function(datatable){
                    $('#m_form_status').on('change', function() {
                        datatable.search($(this).val().toLowerCase(), 'Status');
                    });
                    $('#m_form_type').on('change', function() {
                        datatable.search($(this).val().toLowerCase(), 'Type');
                    });
                    $('#m_form_status, #m_form_type').selectpicker();

                }
            }
        }();


        var statusChart = function() {
            var data = [];
            var series = ['Open', 'Closed', 'Assigned', 'Cancelled', 'Rejected', 'Overdue'];
            var color = [
                mApp.getColor('accent'),
                mApp.getColor('metal'),
                mApp.getColor('success'),
                mApp.getColor('warning'),
                mApp.getColor('info'),
                mApp.getColor('danger')]

            for (var i = 0; i < series.length; i++) {
                data[i] = {
                    label: series[i],
                    color: color[i],
                    data: Math.floor(Math.random() * 100) + 1
                };
            }

            $.plot($("#status_chart"), data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.8
                            }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
        }

        var typeChart = function() {
            var data = [];
            var series = ['Illegal Dumping', 'Faulty Meter', 'Bin not collected', 'Electricity Outage', 'Animal Carcass'];
            var color = [
                mApp.getColor('accent'),
                mApp.getColor('success'),
                mApp.getColor('warning'),
                mApp.getColor('info'),
                mApp.getColor('danger')]

            for (var i = 0; i < series.length; i++) {
                data[i] = {
                    label: series[i],
                    color: color[i],
                    data: Math.floor(Math.random() * 100) + 1
                };
            }

            $.plot($("#types_chart"), data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.8
                            }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
        }

        const columns = [
            {
                field: 'id',
                title: '#',
                type: 'number',
                width: 25
            },
            {
                field: 'LoggedAt',
                type: 'date',
                format: 'YYYY-MM-DD',
            },
            {
                field: 'Location',
                width: 180,
            },
            {
                field: 'Status',
                title: 'Status',
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: {'title': 'Closed', 'class': 'm-badge--metal'},
                        2: {'title': 'Assigned', 'class': ' m-badge--success'},
                        3: {'title': 'Overdue', 'class': ' m-badge--danger'},
                        4: {'title': 'Rejected', 'class': ' m-badge--info'},
                        5: {'title': 'Cancelled', 'class': ' m-badge--warning'},
                        6: {'title': 'Open', 'class': ' m-badge--warning'},
                    };
                    return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
                },
            },
            {
                field: 'Type',
                title: 'Type',
                width: 150,
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: {'title': 'Animal Carcass', 'state': 'warning'},
                        2: {'title': 'Bin not Collected', 'state': 'primary'},
                        3: {'title': 'Illegal Dumping', 'state': 'accent'},
                        4: {'title': 'Electricity Outage', 'state': 'success'},
                        5: {'title': 'Faulty Meter', 'state': 'danger'},
                    };
                    return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' +
                        status[row.Type].state + '">' +
                        status[row.Type].title + '</span>';
                },
            },
            {
                field: "Actions",
                width: 160,
                title: "Actions",
                textAlign: 'left',
                sortable: false,
                locked: {right: 'lg'},
                overflow: 'visible'
            }
        ];
        jQuery(document).ready(function() {
            LoadTypes.init();
            statusChart();
            typeChart();
            TableElement.init($('#incidents'), columns);
            $('#type_id').select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select a category from the list above first...'
                }
            });
        });
    </script>
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
