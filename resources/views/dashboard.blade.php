@extends('layouts.master')

@section('title', 'Dashboard')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))

@section('content')

    @include('widgets.dashboard.incidents-at-a-glance')

    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <div  class="m-portlet m-portlet--head-sm" m-portlet="true" id="dashboard_incidents_table">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-exclamation"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                {{ __('Incidents') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>
                            </li>
                        </ul>
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
                                                    <label class="m-label m-label--single">{{ __('Categories:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_type">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input" placeholder="Search..."
                                                       id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <button type="button" data-toggle="modal" data-target="#log_incident_modal"
                                            class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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
                                <th data-field="Status">{{ __('Status') }}</th>
                                <th data-field="Category">{{ __('Category') }}</th>
                                <th data-field="Location">{{ __('Location') }}</th>
                                <th data-field="SuburbID">{{ __('Suburb') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incidents as $incident)
                                <tr>
                                    <td>{{ $incident->id }}</td>
                                    <td><a href="{{ route('incidents.show', $incident->id) }}"
                                           class="font-weight-bold">{{ $incident->reference }}</a></td>
                                    <td>{{ $incident->name }}</td>
                                    <td>{{ $incident->created_at }}</td>
                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--{{ $incident->status->state_color->css_class }} m-badge--wide">{{ $incident->status->name }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--dot m-badge--{{ $incident->type->categories()->first()->state_color->css_class }}"></span>&nbsp;<span class="m--font-bold m--font-{{$incident->type->categories()->first()->state_color->css_class}}">
                                            {{$incident->type->categories()->first()->name }}</span>
                                        </span>
                                    </td>
                                    <td>{{ $incident->longitude }}, {{ $incident->latitude }}</td>
                                    <td>{{ $incident->suburb_id }}</td>
                                    <td>
                                        <div role="group">
                                            @if(!count($incident->assignments))
                                                <a  href="{{ route('incidents.engineers', $incident->id) }}"
                                                    data-toggle="m-tooltip" data-placement="top"
                                                    data-original-title="Assign Engineer"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill assign-btn">
                                                <i class="la la-user"></i></a>
                                            @endif
                                                <a  href="{{ route('incidents.specialists', $incident->id) }}"
                                                    data-toggle="m-tooltip" data-placement="top"
                                                    data-original-title="Assign Specialist"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill">
                                                <i class="la la-user-secret"></i></a>
                                            <a data-toggle="m-tooltip" data-placement="top"
                                               data-original-title="Assign Working Group"
                                               href="{{ route('incidents.engineers',['incident' => $incident->id,'role_is' => 'working-group']) }}"
                                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                        class="la la-users"></i></a>
                                            <a data-toggle="m-tooltip" data-placement="top"
                                               data-original-title="Edit Details"
                                               href="{{ route('incidents.edit', $incident->id) }}"
                                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                        class="la la-edit"></i></a>
                                        </div>

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
        .m-datatable__lock--right {
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

        .pac-container {
            z-index: 9999;
        }
    </style>
@stop


@section('js')

    {{ Html::script('js/project-mdatatable.js') }}
    <script>
        //table column definitions
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
                title: 'Status'
            },
            {
                field: 'Category',
                title: 'Category',
                width: 150
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

        /**
         * Function REQUIRED!
         */
        const TableMethods = function () {
            return {
                init: function (datatable) {
                    $('#m_form_status').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'Status');
                    });
                    $('#m_form_type').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'Category');
                    });
                    $('#m_form_status, #m_form_type').selectpicker();
                }
            }
        }();
        TableElement.init($('#incidents'), columns);

        var LoadTypes = function () {
            var types = function () {
                $('select[name="category_id"]').on('change', function () {
                    var categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: '/json/types/' + categoryId,
                            type: "GET",
                            dataType: "json",
                            beforeSend: function () {
                                $('#loader').css("visibility", "visible");
                            },
                            success: function (data) {
                                $('select[name="type_id"]').empty();
                                $.each(data.data, function (key, value) {
                                    $('select[name="type_id"]').append('<option value="' + key + '">' + value + '</option>');

                                });
                            },
                            complete: function () {
                                $('#loader').css("visibility", "hidden");
                            }
                        });
                    } else {
                        $('select[name="type_id"]').empty();
                    }
                })
            }

            return {
                init: function () {
                    types()
                }
            }
        }();

        jQuery(document).ready(function () {
            LoadTypes.init();
            $('#type_id').select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Choose a category from the list above first...'
                }
            });
            //Handle Form Validation
            $.validate({
                modules : 'location, security'
            });
            $('#description').restrictLength( $('#desc-max-length') );
        });

    </script>
    <script src="{{ asset('js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap"
            async defer></script>
@endsection

@section('modals')

    <!--begin:: Log Incident Modal-->
    <div class="modal fade" id="log_incident_modal" tabindex="-1" role="dialog" aria-labelledby="logincident"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log Incident</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="log-incident" method="POST" action="{{ route('incidents.store') }}">
                <div class="modal-body">
                        {{ csrf_field() }}
                        @include('backend.incidents._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary m-btn--pill m-btn--air" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn btn-success  m-btn--pill m-btn--air">Confirm
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

@stop
