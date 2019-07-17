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
                                    # {{ $incident->id }} - {{ $incident->reference }}
                                </h3>
                            </div>
                        </div><div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                @if(!count($incident->assignments))
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Assign Engineer" href="{{ route('engineers.list',$incident->id) }}" class="m-portlet__nav-link btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="la la-user-plus"></i>
                                    </a>
                                </li> @endif
                                <li class="m-portlet__nav-item">
                                    <a data-toggle="m-tooltip" data-placement="top" data-original-title="Assign Working Group" href="{{ route('engineers.list',$incident->id) }}" class="m-portlet__nav-link btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--pill">
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
													{{ $incident->type->categories->first()->name }}
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

    {{ Html::script('js/project-mdatatable.js') }}
    <script>
        let Categories = {};
        var LoadCategories = function(){
            var categories = function(){
                let colorCodes = [];
                $.ajax({
                    url: '/backend/categories',
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $.each(data.data, function(key, value){
                            Categories[value.id] = {'title': value.name}
                        });
                    },
                    complete: function(){
                        // Call datatable init function, once everything has loaded
                        TableElement.init($('#incidents'), columns);
                    }
                });
            }

            return {
                init: function(){
                    categories()
                }
            }
        }();
        LoadCategories.init();//Load these first!

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
                        datatable.search($(this).val().toLowerCase(), 'Category');
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
                            radius: 3/4,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.8
                            }
                        }
                    }
                },
                legend: {
                    show: true
                },
                grid: {
                    clickable: true
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
                            radius: 3/4,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.8
                            }
                        }
                    }
                },
                legend: {
                    show: true
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
                width: 200,
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
                        6: {'title': 'Open', 'class': ' m-badge--accent'},
                    };
                    return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
                },
            },
            {
                field: 'Category',
                title: 'Category',
                width: 150,
                // callback function support for column rendering
                template: function(row) {
                    return '<span class="m-badge m-badge--accent m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-accent">' +
                        Categories[row.Category].title+ '</span>';
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