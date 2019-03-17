@extends('layouts.master')

@section('content')

    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">{{ __('User Management') }}</h3>
                    </div>
                </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">


               <!--Begin::Section-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{ __('Users') }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
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
                                                                            <span class="m-nav__link-text">Create Post</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                            <span class="m-nav__link-text">Send Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                                            <span class="m-nav__link-text">Upload File</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__section">
                                                                        <span class="m-nav__section-text">Useful Links</span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                                            <span class="m-nav__link-text">FAQ</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                            <span class="m-nav__link-text">Support</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit m--hide">
                                                                    </li>
                                                                    <li class="m-nav__item m--hide">
                                                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
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
                                                    <div class="col-md-4">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label>{{ __('Status:') }}</label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <select class="form-control m-bootstrap-select" id="m_form_status">
                                                                    <option value="">{{ __('All') }}</option>
                                                                    {{-- @foreach($statuses as $status)
                                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                                    @endforeach --}}
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
                                                                    {{-- @foreach($types as $type)
                                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                                    @endforeach --}}
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
                                                <a href="{{ route('users.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    {{ __('Add User')}}
                                                </span>
                                                </a>
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Search Form -->
                                    <table class="m_datatable" id="users">
                                        <thead>
                                        <tr>
                                            <th data-field="id">{{ __('#') }}</th>
                                            <th data-field="FullName">{{ __('Full Name') }}</th>
                                            <th data-field="ContactNumber">{{ __('Contact Number') }}</th>
                                            <th data-field="Email">{{ __('Email') }}</th>
                                            <th data-field="JoinedAt">{{ __('Joined At') }}</th>
                                            <th data-field="Status">{{ __('Status') }}</th>
                                            <th data-field="Role">{{ __('Role') }}</th>
                                            <th data-field="Actions" style="text-align: right;">{{ __('Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->contactnumber }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->status_is }}</td>
                                            <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary m-btn m-btn--custom m-btn--pill pull-left " style="margin-right: 3px;">Edit</a>

                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                                                <button type="submit" class="btn btn-link">Delete</button>
                                                {!! Form::close() !!}
                                            </td>
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

            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .m-datatable__lock--right{
            overflow: visible !important;
        }
    </style>
@stop


@section('js')
    <script>
        var IncidentsTable = function() {
            var incidents = function() {

                var datatable = $('#users').mDatatable({
                    data: {
                        saveState: {cookie: false},
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
                        autoHide: true,
                    },

                    sortable: true,

                    filterable: false,

                    pagination: true,
                    search: {
                        input: $('#generalSearch'),
                    },
                    columns: [
                        {
                            field: 'id',
                            title: '#',
                            type: 'number',
                            width: 25
                        },
                        {
                            field: 'JoinedAt',
                            type: 'date',
                            format: 'YYYY-MM-DD',
                        },
                        // {
                        //     field: 'Status',
                        //     title: 'Status',
                        //     // callback function support for column rendering
                        //     template: function(row) {
                        //         var status = {
                        //             1: {'title': 'Closed', 'class': 'm-badge--brand'},
                        //             2: {'title': 'Assigned', 'class': ' m-badge--success'},
                        //             3: {'title': 'Overdue', 'class': ' m-badge--danger'},
                        //             4: {'title': 'Rejected', 'class': ' m-badge--info'},
                        //             5: {'title': 'Cancelled', 'class': ' m-badge--warning'},
                        //             6: {'title': 'Open', 'class': ' m-badge--warning'},
                        //         };
                        //         return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
                        //     },
                        // },
                        // {
                        //     field: 'Type',
                        //     title: 'Type',
                        //     width: 150,
                        //     // callback function support for column rendering
                        //     template: function(row) {
                        //         var status = {
                        //             1: {'title': 'Animal Carcass', 'state': 'warning'},
                        //             2: {'title': 'Bin not Collected', 'state': 'primary'},
                        //             3: {'title': 'Illegal Dumping', 'state': 'accent'},
                        //             4: {'title': 'Electricity Outage', 'state': 'success'},
                        //             5: {'title': 'Faulty Meter', 'state': 'danger'},
                        //         };
                        //         return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' +
                        //             status[row.Type].state + '">' +
                        //             status[row.Type].title + '</span>';
                        //     },
                        // },
                        // {
                        //     field: "Actions",
                        //     width: 110,
                        //     title: "Actions",
                        //     textAlign: 'center',
                        //     sortable: false,
                        //     locked: {right: 'lg'},
                        //     overflow: 'visible',
                        //     template: function(row, index, datatable) {
                        //         var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
                        //         return '\
                        //             <div class="dropdown ' + dropup + '">\
                        //                 <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                        //                     <i class="la la-ellipsis-h"></i>\
                        //                 </a>\
                        //                 <div class="dropdown-menu dropdown-menu-right">\
                        //                     <a class="dropdown-item" href="/incidents/' + row.id + '/edit"><i class="la la-edit"></i> Edit Details</a>\
                        //                     <a class="dropdown-item" href="#"><i class="flaticon-cogwheel-1"></i> Assign Engineer</a>\
                        //                     <a class="dropdown-item" href="#"><i class="flaticon-network"></i> Assign Working Group</a>\
                        //                 </div>\
                        //             </div>\
                        //             <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Close Incident">\
                        //                 <i class="flaticon-interface-5"></i>\
                        //             </a>\
                        //         ';
                        //     }
                        // }
                    ],
                });

                $('#m_form_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#m_form_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Type');
                });

                $('#m_form_status, #m_form_type').selectpicker();

            };

            return {
                //== Public functions
                init: function() {
                    // init incidents
                    incidents();
                },
            };
        }();
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
        jQuery(document).ready(function() {
            LoadTypes.init();
            IncidentsTable.init();
        });
    </script>
@endsection

@section('modals')

    <!--begin::Modal-->
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
