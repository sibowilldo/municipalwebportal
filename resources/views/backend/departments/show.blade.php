@extends('layouts.master')

@section('title', 'Departments')
@section('breadcrumbs', Breadcrumbs::render('departments.show', $department))

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile m-form">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ $department->name }} {{ __(' Details') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-dark m-btn--hover-dark">
                                    Quick Actions
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Available Actions</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('departments.create') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-edit"></i>
                                                            <span class="m-nav__link-text">Edit Details</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('departments.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list-ul"></i>
                                                            <span class="m-nav__link-text">View All Departments</span>
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
                    <div class="m-widget13">
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                 #
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $department->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $department->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Email:
                            </span>
                            <span class="m-widget13__text">
                                {{ $department->email }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Contact Number:
                            </span>
                            <span class="m-widget13__text">
                                {{ $department->contact_number }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Created on:
                            </span>
                            <span class="m-widget13__text">
                             {{ title_case(\Carbon\Carbon::parse($department->created_at)->format('d M yy, h:m:s')) }}
                            </span>
                        </div>

                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                District:
                            </span>
                            <span class="m-widget13__text">
                             {{ $department->district()->withTrashed()->first()->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile"><div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Users in this department
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m_datatable">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-12 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-form__group">
                                                <div class="m-form__label">
                                                    <label>{{ __('Status:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_status">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($statuses as $status)
                                                            <option
                                                                value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">{{ __('Roles:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_type">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">{{ __('Search Phrase:') }}</label>
                                                </div>
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
                                </div>
                            </div>
                        </div>

                        <!--end: Search Form -->
                        <table class="m_datatable" id="users">
                            <thead>
                            <tr>
                                <th data-field="user">{{ __('User') }}</th>
                                <th data-field="contactNumber">{{ __('Contact Number') }}</th>
                                <th data-field="role">{{ __('Role') }}</th>
                                <th data-field="actions">{{ __('Actions') }}</th>
                                <th data-field="status">{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div>
                                            <div class="m-card-user">
                                                <div class="m-card-user__pic">
                                                    <img src="{{ Avatar::create($user->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 40])}}" class="m--img-rounded m--marginless" />
                                                </div>
                                                <div class="m-card-user__details"><span class="m-card-user__name m--regular-font-size-lg1">{{ $user->fullname }}</span>
                                                    <a class="m-card-user__email m-link m--regular-font-size-sm1" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->contactnumber }}</td>
                                    <td>
                                        {{ ucwords($user->roles()->pluck('name')->implode(', ')) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->uuid) }}" data-toggle="m-tooltip"
                                           title="Edit User" data-placement="left" data-original-title="Edit User"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-edit"></i></a>
                                    </td>
                                    <td><span><span class="m-badge m-badge--dot m-badge--{{ $user->status->state_color->css_class }}"
                                            ></span> {{ ucfirst($user->status->name) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const UsersTable = function () {
            var users = function () {
                var datatable = $('#users').mDatatable({
                    data: {
                        saveState: {cookie: true}
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
                    filterable: true,
                    pagination: true,
                    search: {
                        input: $('#generalSearch')
                    },
                    columns: [
                        {
                            field: 'user',
                            title: 'User',
                            width: 250,
                        },
                        {
                            field: 'actions',
                            title: 'Actions',
                            width: 90,
                            locked: {right: 'lg'}
                        }
                    ],
                });

                $('#m_form_status').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#m_form_type').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'Role');
                });

                $('#m_form_status, #m_form_type').selectpicker();

            };
            return {
                //== Public functions
                init: function () {
                    // init users
                    users();
                },
            };
        }();
        jQuery(document).ready(function() {
            UsersTable.init();
        });
    </script>
@endsection
