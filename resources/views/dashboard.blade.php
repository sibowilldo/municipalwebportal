@extends('layouts.master')

@section('title', 'Dashboard')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))

@section('content')

    @include('widgets.dashboard.incidents-at-a-glance')

    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <div  class="kt-portlet kt-portlet--head-sm" kt-portlet="true" id="dashboard_incidents_table">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-caption">
                        <div class="kt-portlet__head-title">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-exclamation"></i>
                            </span>
                            <h3 class="kt-portlet__head-text">
                                {{ __('Incidents') }}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__head-tools">
                        <ul class="kt-portlet__nav">
                            <li class="kt-portlet__nav-item mr-3">
                                <button type="button" data-toggle="modal" data-target="#log_incident_modal"
                                        class="btn btn-danger kt-btn kt-btn--custom kt-btn--icon kt-btn--air kt-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Log Incident') }}</span>
                                    </span>
                                </button>
                            </li>
                            <li class="kt-portlet__nav-item">
                                <a href="" kt-portlet-tool="toggle" class="kt-portlet__nav-link btn btn-sm btn-secondary  kt-btn kt-btn--icon kt-btn--icon-only kt-btn--pill"><i class="la la-angle-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">

                @include('layouts.form-errors')
                <!--begin: Datatable -->
                    <div class="kt_datatable">
                        <!--begin: Search Form -->
                        <div class="kt-form kt-form--label-align-right kt--margin-top-20 kt--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group kt-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="kt-form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>{{ __('Status:') }}</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <select class="form-control kt-bootstrap-select" id="kt_form_status">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($statuses as $status)
                                                            <option value="{{ $status->name }}">{{ $status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none kt--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="kt-form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label class="kt-label kt-label--single">{{ __('Categories:') }}</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <select class="form-control kt-bootstrap-select" id="kt_form_type">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none kt--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input type="text" class="form-control kt-input" placeholder="Search..."
                                                       id="generalSearch">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="col-xl-4 order-1 order-xl-2 kt--align-right">--}}
{{--                                    <button type="button" data-toggle="modal" data-target="#log_incident_modal"--}}
{{--                                            class="btn btn-primary kt-btn kt-btn--custom kt-btn--icon kt-btn--air kt-btn--pill">--}}
{{--                                    <span>--}}
{{--                                        <i class="la la-plus"></i>--}}
{{--                                        <span>{{ __('Log Incident') }}</span>--}}
{{--                                    </span>--}}
{{--                                    </button>--}}
{{--                                    <div class="kt-separator kt-separator--dashed d-xl-none"></div>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <!--end: Search Form -->
                        <table class="kt_datatable" id="incidents">
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
                                            <span class="kt-badge kt-badge--{{ $incident->status->state_color->css_class }} kt-badge--wide">{{ $incident->status->name }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="kt-badge kt-badge--dot kt-badge--{{ $incident->type->categories()->first()->state_color->css_class }}"></span>&nbsp;<span class="kt--font-bold kt--font-{{$incident->type->categories()->first()->state_color->css_class}}">
                                            {{$incident->type->categories()->first()->name }}</span>
                                        </span>
                                    </td>
                                    <td>{{ $incident->longitude }}, {{ $incident->latitude }}</td>
                                    <td>{{ $incident->suburb_id }}</td>
                                    <td>
                                        <div role="group">
{{--                                            @if(!in_array($incident->status->name, $statuses->whereIn('name', ['Deleted', 'Trashed', 'Completed', 'Cancelled'])->pluck('name')->toArray()))--}}
                                                <a  href="{{ route('incidents.engineers', $incident->id) }}"
                                                    data-toggle="kt-tooltip" data-placement="top"
                                                    data-original-title="Assign Engineer"
                                                    class="kt-portlet__nav-link btn kt-btn kt-btn--hover-accent kt-btn--icon kt-btn--icon-only kt-btn--pill assign-btn">
                                                <i class="la la-user"></i></a>
                                                <a  href="{{ route('incidents.specialists', $incident->id) }}"
                                                    data-toggle="kt-tooltip" data-placement="top"
                                                    data-original-title="Assign Specialist"
                                                    class="kt-portlet__nav-link btn kt-btn kt-btn--hover-accent kt-btn--icon kt-btn--icon-only kt-btn--pill">
                                                <i class="la la-user-secret"></i></a>
                                                <a data-toggle="kt-tooltip" data-placement="top"
                                                   data-original-title="Assign Working Group"
                                                   href="{{ route('incidents.groups',['incident' => $incident->id]) }}"
                                                   class="kt-portlet__nav-link btn kt-btn kt-btn--hover-accent kt-btn--icon kt-btn--icon-only kt-btn--pill"><i
                                                            class="la la-users"></i></a>
{{--                                            @endif--}}
                                                <a data-toggle="kt-tooltip" data-placement="top"
                                                   data-original-title="Edit Details"
                                                   href="{{ route('incidents.edit', $incident->id) }}"
                                                   class="kt-portlet__nav-link btn kt-btn kt-btn--hover-accent kt-btn--icon kt-btn--icon-only kt-btn--pill"><i
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
        .kt-datatable__lock--right {
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

{{--    {{ Html::script('js/project-mdatatable.js') }}--}}
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
                    $('#kt_form_status').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'Status');
                    });
                    $('#kt_form_type').on('change', function () {
                        datatable.search($(this).val().toLowerCase(), 'Category');
                    });
                    $('#kt_form_status, #kt_form_type').selectpicker();
                }
            }
        }();
        // TableElement.init($('#incidents'), columns);

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

    @include('modals._incident-form')

@stop
