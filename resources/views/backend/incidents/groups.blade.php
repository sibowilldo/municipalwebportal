@extends('layouts.master')


@section('title', 'Assign Working Group')
@section('breadcrumbs', Breadcrumbs::render('incidents.groups', $incident))

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Assign Working Group') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin: Datatable -->
                    <div class="m_datatable">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-8">
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
                                    <a href="{{ route('working-groups.create', ['payload'=>$incident->uuid]) }}" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Create & Assign New Group') }}</span>
                                    </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <table class="m_datatable" id="working_groups">
                            <thead>
                            <tr>
                                <th data-field="Leader">{{ __('Leader') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="Status">{{ __('Status') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                                <th data-field="# of Members">{{ __('# of Members') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $working_group)
                                <tr>
                                    <td>
                                        @if($working_group->users()->where('is_leader', true)->first())
                                            <div>
                                                <div class="m-card-user">
                                                    <div class="m-card-user__pic">
                                                        <img src="{{ Avatar::create($working_group->users()->where('is_leader', true)->first()->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 40])}}" class="m--img-rounded m--marginless" />
                                                    </div>
                                                    <div class="m-card-user__details"><span class="m-card-user__name m--regular-font-size-lg1">{{ $working_group->users()->where('is_leader', true)->first()->fullname }}</span>
                                                        <a class="m-card-user__email m-link m--regular-font-size-sm1" href="mailto:{{ $working_group->users()->where('is_leader', true)->first()->email }}">{{ $working_group->users()->where('is_leader', true)->first()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            'No Leader Assigned'
                                        @endif
                                    </td>
                                    <td>{{ $working_group->name }}</td>
                                    <td>
                                        <span>

                                        <span
                                            class="m-badge  m-badge--dot shadow m-badge--{{ $working_group->is_active ? 'success' : 'light' }} m-badge--wide"></span>
                                        &nbsp;<span class="m--font-bold">{{ $working_group->is_active ? 'Active' : 'Inactive' }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="m-switch m-switch--sm m-switch--icon">
                                            <label>
                                                <input type="radio" name="radio_working_group"  class="assigned-working-group"
                                                       data-id="{{ $working_group->id }}"
                                                       data-name="{{ $working_group->name }}"
                                                        {{ ($assigned_group?$assigned_group->assignable->id === $working_group->id:false) ? 'checked' : '' }}
                                                >
                                                <span></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td>
                                        {{ count($working_group->users) }}
                                    </td>
                                    <td>{{ $working_group->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--end: Datatable -->
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
                @include('layouts.form-errors')
                <div class="m-portlet__body m-portlet__body--no-padding position-relative">
                    <div class="tab-content">
                        <div id="event-details" class="tab-pane active show">
                            <div class="m-widget1">
                                {!! Form::open(array('route' => array('incidents.assign', $incident->id), 'method' => 'POST')) !!}
                                {{ Form::hidden('is_group', true) }}
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
                                            Category
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
                                            Assigned Personnel
                                        </label>
                                        <span class="m-widget4__sub">
                                                {{ Form::text('assigned', null, [
                                                    "id" => "assigned",
                                                    "class"=>"form-control m-input",
                                                    "data-id" => "",
                                                    "disabled"=>"disabled"]) }}
                                            </span>
                                        {{ Form::hidden('assigned_id') }}
                                        {{ Form::hidden('is_group', true) }}
                                    </div>
                                </div><div class="m-widget1__item">
                                    <div class="m-widget4__info">
                                        <label for="engineers-list" class="m-widget4__title m--font-boldest">
                                            Instructions
                                        </label>
                                        <div class="mb-5">
                                                 <span class="m-widget4__sub">
                                                     {{ Form::textarea('instructions', old('instructions'),
                                                        ["id" => "instructions","class"=>"form-control m-input"]) }}
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
                                    <input id="searchMapInput" class="form-control m-input" type="hidden" placeholder="Enter a location">
                                    <div id="map"
                                         data-latitude="{{ $incident->latitude }}"
                                         data-longitude="{{ $incident->longitude }}"
                                         data-location-description="{{ $incident->location_description }}"
                                         style="top:0;bottom: 8px;left:0;right:0; position: absolute; overflow: hidden;">
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

                                    <input type="hidden" id="latitude" value="{{ $incident->latitude }}">
                                    <input type="hidden" id="longitude" value="{{ $incident->longitude }}">
                                    <input type="hidden" id="longitude" value="{{ $incident->longitude }}">
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
    {{--    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoBJMrVixK0pJrgDih4jwykKILuSnql5M&callback=initMap" async defer></script>--}}
    <script>
        // Initialize and add the map
        function initMap() {
            // Get The location
            let lat = $('#map').data('latitude'), long = $('#map').data('longitude'), loc_desc=$('#map').data('location-description');
            let loc = {lat: parseFloat(lat), lng: parseFloat(long)};


            console.log(loc_desc);
            // The map, centered at the Location
            let map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: loc,
                    disableDefaultUI: true,
                    gestureHandling: 'cooperative'});
            // The marker, positioned at the Location
            let marker = new google.maps.Marker({position: loc, map: map});

            let infowindow = new google.maps.InfoWindow();

            infowindow.setContent(
                '<div>'+loc_desc+'</div><br>'+
                '<strong>Lat: </strong>' + lat +
                ', <strong>Long: </strong>'+ long);
            infowindow.open(map, marker);
        }
    </script>
    <script type="text/javascript">
        //Global Declaration and Initialization
        let GroupSelection = JSON.parse(localStorage.getItem('GroupSelection')) || {}, engineerSelect = $('.m-select2').select2();
        if (performance.navigation.type !== 1) {
            GroupSelection = {};
        }
        const GroupsTable = function()
        {
            var groups = function() {
                var datatable = $('#working_groups').mDatatable({
                    data: {
                        saveState: {cookie: true}
                    },
                    layout: {
                        theme: 'default',
                        class: '',
                        scroll: true,
                        height: 550,
                        footer: true
                    },
                    rows: {
                        // auto hide columns, if rows overflow
                        autoHide: true,
                    },
                    sortable: true,
                    filterable: true,
                    pagination: false,
                    search: {
                        input: $('#generalSearch')
                    },
                    columns: [
                        {
                            field: 'Leader',
                            title: 'Leader',
                            width: 240
                        },
                        {
                            field: '# of Members',
                            title: '# of Members',
                            type: 'number',
                            width: 100
                        },
                        {
                            field: 'Name',
                            title: 'Name',
                            type: 'text',
                            width: 200
                        },
                        {
                            field: 'Active',
                            title: 'Active',
                            sortable: false,
                            width: 50,
                            autoHide: true
                        },
                        {
                            field: 'Actions',
                            title: 'Actions',
                            sortable: false,
                            width: 110,
                            overflow: 'visible',
                        },
                        {
                            field: 'Description',
                            title: 'Description',
                            type: 'text',
                            autoHide: true,
                            width: 350
                        }
                    ],

                });
                // DataTable Events
                datatable.on("m-datatable--on-layout-updated", function () {
                    //Remember which radio was checked, when the table gets re-rendered
                    let elem = $('.assigned-working-group[data-id="'+GroupSelection.id+'"]' );
                    elem.prop('checked', GroupSelection.state);

                });
                datatable.on("change", ".assigned-working-group", function () {
                    let item = $(this),elAssigned = $('input[name=assigned]');
                    if(item.is(':checked')){
                        elAssigned.val(item.data('name'));
                        $('input[name=assigned_id]').val(item.data('id'));
                        jQuery.notify({
                            message: item.data('name') + " was assigned. <br>Click <strong>Save Changes</strong> to commit.",
                            icon: "icon la la-check-circle"
                        }, {
                            type: "success",
                            animate: {
                                enter: 'animated slideInRight',
                                exit: 'animated slideOutRight'
                            }
                        });
                    }
                    GroupSelection = { id:item.data('id'), name:item.data('name'), state: this.checked};
                    localStorage.setItem("GroupSelection", JSON.stringify(GroupSelection));
                });
                $('#m_user_role').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'Role');
                });
            };
            return {
                //== Public functions
                init: function() {
                    // init engineers
                    groups();
                }
            };
        }();
        const UpdateElemsOnLoad = function()
        {
            let updateFx = function () {
                // On page load remember the state
                let item = $('.assigned-working-group[data-id="'+GroupSelection.id+'"]' ),elAssigned = $('input[name=assigned]');
                elAssigned.val(GroupSelection.name);
                $('input[name=assigned_id]').val(GroupSelection.id);

                item.prop('checked', GroupSelection.state);
            }
            return {
                init: function () {
                    updateFx();
                }
            }
        }();
        $(document).on("m-datatable--on-init", function () {
            let checkboxes = $('.assigned-working-group:checked');
            $.each(checkboxes, function (k, v) {
                v = $(v);
                GroupSelection = { id:v.data('id'), name:v.data('name'), state: this.checked };
                localStorage.setItem("GroupSelection", JSON.stringify(GroupSelection));
            })
        });
        $(document).ready(function() {
            $('.m_selectpicker').selectpicker();
            GroupsTable.init();
            UpdateElemsOnLoad.init();
        });
    </script>
@endsection
