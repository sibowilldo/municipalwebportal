@extends('layouts.master')


@section('title', 'Users')
@section('breadcrumbs', Breadcrumbs::render('users.index'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--mobile ">
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
                                <div
                                    class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                    m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-dark m-btn--hover-dark">
                                        Quick Actions
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span
                                            class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">Quick Actions</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-users-1"></i>
                                                                <span class="m-nav__link-text">Manage Roles</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('permissions.index') }}"
                                                               class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-safe-shield-protection"></i>
                                                                <span class="m-nav__link-text">Manage Permissions</span>
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
                                            <div class="m-form__group m-form__group--inline">
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
                                            <div class="m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">{{ __('Roles:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <select class="form-control m-bootstrap-select" id="m_form_role">
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
                                            <div class="m--margin-bottom-10"></div>
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">{{ __('Search:') }}</label>
                                                </div>
                                                <div class="m-form__control">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input" placeholder="Search..."
                                                               id="generalSearch">
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('users.create') }}"
                                       class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--sm">
                                    <span>
                                        {{ __('Create User')}}
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
                                {{--                                <th data-field="uuid">{{ __('id') }}</th>--}}
                                <th data-field="user">{{ __('User') }}</th>
                                <th data-field="contactNumber">{{ __('Contact Number') }}</th>
                                <th data-field="role">{{ __('Role') }}</th>
                                <th data-field="department">{{ __('Department') }}</th>
                                <th data-field="actions">{{ __('Actions') }}</th>
                                <th data-field="status">{{ __('Status') }}</th>
                                <th data-field="joinedAt">{{ __('Joined At') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    {{--                                <td>{{ $user->uuid }}</td>--}}
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
                                        {{ ucwords($user->roles->pluck('name')->implode(', ')) }}
                                    </td>
                                    <td>
                                        {{ $user->departments->first()? $user->departments->first()->name:'Not Assigned/Applicable' }}
                                    </td>
                                    <td>
                                            <a href="{{ route('users.edit', $user->uuid) }}" data-toggle="m-tooltip"
                                               title="Edit User" data-placement="left" data-original-title="Edit User"
                                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                    class="la la-edit"></i></a>
                                            @if(Auth::user()->uuid !== $user->uuid)
                                            @if ($user->deleted_at)
                                                <button
                                                    type="button"
                                                    data-id="{{ $user->uuid }}"
                                                    data-url="{{ route('users.restore', $user->uuid) }}"
                                                    data-toggle="m-tooltip"
                                                    title="Restore User"
                                                    data-placement="left"
                                                    data-original-title="Restore User"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon btn-sm m-btn--sm m-btn--pill btn-restore">
                                                    <i class="la la-recycle"></i> Restore
                                                </button>
                                            @else
                                                <button
                                                    type="button"
                                                    data-id="{{ $user->uuid }}"
                                                    data-url="{{ route('users.destroy', $user->uuid) }}"
                                                    data-toggle="m-tooltip"
                                                    title="Delete User"
                                                    data-placement="left"
                                                    data-original-title="Delete User"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon btn-sm m-btn--sm m-btn--pill btn-delete">
                                                    <i class="la la-trash"></i> Delete
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                    <td><span><span class="m-badge m-badge--dot m-badge--{{ $user->status->state_color->css_class }}"
                                                    ></span> {{ $user->status->name }}</span>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
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
    </style>
@stop


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
                        footer: true
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
                            field: 'uuid',
                            title: '#',
                            width: 25,
                            selector: {
                                class: "m-checkbox--solid m-checkbox--brand"
                            }
                        },
                        {
                            field: 'user',
                            title: 'User',
                            width: 250,
                        },,
                        {
                            field: 'status',
                            title: 'Status'
                        },
                        {
                            field: 'joinedAt',
                            type: 'date',
                            format: 'YYYY-MM-DD',
                        },
                        {
                            field: 'actions',
                            title: 'Actions',
                            width: 160,
                            locked: {right: 'lg'}
                        }
                    ],
                });

                datatable.on('click', '.btn-delete', function (e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    var token = $("meta[name='csrf-token']").attr("content");
                    swalDelete.fire({
                        title: 'Are you sure?',
                        text: "You may not be able to undo this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete user!',
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                $.ajax({
                                    url: url,
                                    type: 'delete',
                                    data: {
                                        "id": id,
                                        "_token": token
                                    }
                                })
                                    .done(function (response) {
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: response.message,
                                            onClose: function () {
                                                window.location.href = response.url;
                                            }
                                        })
                                    })
                                    .fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            });
                        },
                        allowOutsideClick: false
                    })
                });
                datatable.on('click', '.btn-restore', function (e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    var token = $("meta[name='csrf-token']").attr("content");
                    swalDelete.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        confirmButtonText: 'Yes, restore user!',
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                        "id": id,
                                        "_token": token
                                    }
                                })
                                    .done(function (response) {
                                        Swal.fire({
                                            title: 'Restored!',
                                            text: response.message,
                                            onClose: function () {
                                                window.location.href = response.url;
                                            }
                                        })
                                    })
                                    .fail(function () {
                                        Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            });
                        }
                    })
                });

                $('#m_form_status').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });

                $('#m_form_role').on('change', function () {
                    console.log($(this).val());
                    datatable.search($(this).val().toLowerCase(), 'role');
                });

                $('#m_form_status, #m_form_role').selectpicker();

            };
            return {
                //== Public functions
                init: function () {
                    // init users
                    users();
                },
            };
        }();
        jQuery(document).ready(function () {
            UsersTable.init();
        });

    </script>
@endsection

