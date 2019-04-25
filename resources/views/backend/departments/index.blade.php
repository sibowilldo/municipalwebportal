@extends('layouts.master')


@section('title', 'Departments ')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Departments') }}
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
                                                        <li class="m-nav__section">
                                                            <span class="m-nav__section-text">Useful Links</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('departments.create') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-building"></i>
                                                                <span class="m-nav__link-text">Add New Department</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('users.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-users"></i>
                                                                <span class="m-nav__link-text">Users</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-users-1"></i>
                                                                <span class="m-nav__link-text">Available Roles</span>
                                                            </a>
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
                        <table class="m_datatable" id="departments">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="District">{{ __('District') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                                <th data-field="Contact Number">{{ __('Contact Number') }}</th>
                                <th data-field="Email">{{ __('Email') }}</th>
                                <th data-field="Alt">{{ __('Alt. Contact Number') }}</th>
                                <th data-field="Address">{{ __('Address') }}</th>
                                <th data-field="Status">{{ __('Status') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->district }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>{{ $department->contact_number }}</td>
                                    <td><a href="mailto:{{ $department->email }}">{{ $department->email }}</a></td>
                                    <td>{{ $department->alt_contact_number }}</td>
                                    <td>{{ $department->address }}</td>
                                    <td>{{ $department->status_is }}</td>
                                    <td>
                                        <a href="{{ route('departments.edit', $department->id) }}">Edit</a>
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

@endsection

@section('js')
    {{ Html::script('js/project-mdatatable.js') }}
    <script>
        const TableMethods = function(){
            return{
                init:function(datatable){

                }
            }
        }();
        const columns = [
            {
                field: 'id',
                title: '#',
                type: 'number',
                width: 25
            },
            {
                field: 'Address',
                title: 'Address',
                type: 'text',
                width: 300
            },
            {
                field: 'Alt',
                title: 'Alt. Contact Number',
                type: 'text',
                autoHide: true,
                width: 200
            },
            {
                field: 'Status',
                title: 'Status',
                autoHide: true,
            // callback function support for column rendering
                template: function(row) {
                var status = {
                    'available': {'title': 'Available', 'state': 'primary'},
                    'inactive': {'title': 'Inactive', 'state': 'accent'},
                    'active': {'title': 'Active', 'state': 'success'},
                    'blocked': {'title': 'Blocked', 'state': 'danger'},
                };
                return '<span class="m-badge m-badge--' + status[row.Status].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' +
                    status[row.Status].state + '">' +
                    status[row.Status].title + '</span>';
        },
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
            }
        ];
        jQuery(document).ready(function() {

            TableElement.init($('#departments'), columns);
        });

    </script>
@endsection
