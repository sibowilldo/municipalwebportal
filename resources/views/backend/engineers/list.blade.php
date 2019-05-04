@extends('layouts.master')


@section('title', 'Assign Engineer')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Engineers') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row m-row">
                        <div class="col-lg-12">
                            <!--begin: Datatable -->
                            <div class="m_datatable">
                                <!--begin: Search Form -->
                                <div class="m-form m-form--label-align-right m--margin-30">
                                    <div class="row align-items-end">
                                        <div class="col-xl-12 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
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
                                    </div>
                                </div>

                                <!--end: Search Form -->
                                <div class="m-widget11">
                                    <div class="table-responsive">
                                        <table class="table table-condensed" id="engineers">
                                            <thead>
                                            <tr>
                                                <th data-field="id">{{ __('#') }}</th>
                                                <th data-field="FullName">{{ __('Full Name') }}</th>
                                                <th data-field="ContactNumber">{{ __('Contact Number') }}</th>
                                                <th data-field="Email">{{ __('Email') }}</th>
                                                <th data-field="Assign">{{ __('Assign') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($engineers as $engineer)
                                                <tr>
                                                    <td>{{ $engineer->id }}</td>
                                                    <td>{{ $engineer->fullname }}</td>
                                                    <td>{{ $engineer->contactnumber }}</td>
                                                    <td>{{ $engineer->email }}</td>
                                                    <td>
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                                    <label>
                                                        <input type="checkbox"  class="assigned-engineer" data-id="{{ $engineer->id }}" data-name="{{ $engineer->fullname }}">
                                                        <span></span>
                                                    </label>
                                                </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Incident Details
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#event-details" role="tab">
                                    Details
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#event-location" role="tab">
                                    Location
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget14">
                        <div class="m-widget14__items">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="display-1 m--font-info m--align-center">{{ $incident->created_at->format('H:i:s') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="event-details" class="tab-pane active show">

                            <div class="m-widget1">
                                {!! Form::open(array('route' => array('engineers.assign', $incident->id), 'method' => 'POST')) !!}
                                    {{ csrf_field() }}
                                    {{ Form::hidden('user_id', $engineer->id) }}
                                    {{ Form::hidden('incident_id', $incident->id) }}
                                    <div class="m-widget1__item">
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__title m--font-boldest">
                                            Reference
                                        </span><br>
                                            <span class="m-widget4__sub">
                                            {{ $incident->reference }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__title m--font-boldest">
                                            Logged at
                                        </span><br>
                                            <span class="m-widget4__sub">
                                            {{ $incident->created_at }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__title m--font-boldest">
                                            Type
                                        </span><br>
                                            <span class="m-widget4__sub">
                                            {{ $incident->type->name }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="m-widget4__info">
                                        <span class="m-widget4__title m--font-boldest">
                                            Status
                                        </span><br>
                                            <span class="m-widget4__sub">
                                            {{ $incident->status->name }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="m-widget4__info">
                                        <label for="engineers-list" class="m-widget4__title m--font-boldest">
                                            Assigned Engineers
                                        </label>
                                        <div class="mb-5">
                                             <span class="m-widget4__sub">
                                                 {{ Form::text('assigned_engineers', null,
                                                    ["id" => "engineers-list",
                                                    "data-role"=>"tagsinput",
                                                    "class"=>"form-control m-input",
                                                    "multiple"=>"multiple"]) }}
                                                <br>
                                                <button class="btn btn-success m--margin-top-20 m-btn--pill" type="submit">Save Changes</button>
                                            </span>
                                        </div>

                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div id="event-location" class="tab-pane">
                            <div class="m-widget15">
                                <div class="m-widget15__map m-portlet__pull-sides">
                                    <input id="searchMapInput" class="form-control m-input" type="text" placeholder="Enter a location">
                                    <div id="map" style="height: 340px; position: relative; overflow: hidden;">
                                        <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                                            <div class="gm-err-container"><div class="gm-err-content">
                                                    <div class="gm-err-icon">
                                                        <img src="http://maps.gstatic.com/mapfiles/api-3/images/icon_error.png" draggable="false" style="user-select: none;"></div>
                                                    <div class="gm-err-title">Oops! Something went wrong.</div>
                                                    <div class="gm-err-message">This page didn't load Google Maps correctly. See the JavaScript console for technical details.</div>
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
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">

        //Global Declaration and Initialization
        let EngineerSelection = JSON.parse(localStorage.getItem('EngineerSelection')) || {},
            elt = $('#engineers-list');

        elt.tagsinput({
            itemValue: function(item) {
                return item.id;
            },
            itemText: function(item) {
                return item.name;
            }
        });

        const EngineersTable = function()
        {
            var engineers = function() {
                var datatable = $('#engineers').mDatatable({
                    data: {
                        saveState: {cookie: false}
                    },
                    layout: {
                        theme: 'default',
                        class: '',
                        scroll: true,
                        height: 550,
                        footer: false
                    },
                    rows: {
                        // auto hide columns, if rows overflow
                        autoHide: false,
                    },
                    sortable: false,
                    filterable: false,
                    pagination: false,
                    search: {
                        input: $('#generalSearch')
                    },
                    columns: [
                        {
                            field: 'id',
                            title: '#',
                            type: 'number',
                            width: 25
                        },
                        {
                            field: 'Assign',
                            title: 'Assign',
                            width: 150
                        }
                    ],
                });
                // DataTable Events
                datatable.on("m-datatable--on-layout-updated", function () {
                    //Remember which check boxes where checked, when the table gets re-rendered
                    $.each(EngineerSelection, function(key, value) {
                        let elem = $('.assigned-engineer[data-id="'+key+'"]' );
                        elem.prop('checked', value.state);
                    });

                });
                datatable.on("change", ".assigned-engineer", function () {
                    let item = $(this),
                        tag = { 'id': item.data('id'), 'name': item.data('name')};
                    if(item.is(':checked')){
                        elt.tagsinput('add', tag);
                        jQuery.notify({
                            message: item.data('name') + " was assigned. <br>Click <strong>Save Changes</strong> to commit.",
                            icon: "icon la la-check-circle"
                            }, {
                            type: "success"
                        });

                    }else {
                        elt.tagsinput('remove', tag);
                        jQuery.notify({
                            message: item.data('name') + " was unassigned. <br>Click <strong>Save Changes</strong> to commit.",
                            icon: "icon la la-info-circle"
                        }, {
                            type: "info"
                        });
                    }
                    EngineerSelection[item.data('id')] = { id:item.data('id'), name:item.data('name'), state: this.checked  };
                    localStorage.setItem("EngineerSelection", JSON.stringify(EngineerSelection));
                });
            };
            return {
                //== Public functions
                init: function() {
                    // init engineers
                    engineers();
                }
            };
        }();

        const UpdateElems = function()
        {
            let updateFx = function () {
                // On page load
                $.each(EngineerSelection, function(key, value) {
                    let elem = $('.assigned-engineer[data-id="'+key+'"]' );
                    elem.prop('checked', value.state);
                    if(elem.is(":checked")){
                        let tag = { 'id': elem.data('id'), 'name': elem.data('name')};
                        elt.tagsinput('add', tag);
                    }
                });
            }

            return {
                init: function () {
                    updateFx();
                }
            }
        }();

        $(document).ready(function() {
            $('#engineers-list').on('itemRemoved', function(event) {
                console.log(event.item);
            });

            EngineersTable.init();
            UpdateElems.init();

        });

    </script>
    <script src="{{ asset('js/google-maps.js') }}"></script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap" async defer></script>--}}
@endsection
