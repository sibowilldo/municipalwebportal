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
                                                            <a href="{{ route('roles.index') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-users-1"></i>
                                                                <span class="m-nav__link-text">Manage Roles</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('permissions.index') }}" class="m-nav__link">
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
                                                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-form__group m-form__group--inline">
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
                                <td>{{ ucfirst($user->status_is) }}</td>
                                <td>
                                   {{ ucwords($user->roles()->pluck('name')->implode(', ')) }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary m-btn " style="margin-right: 3px;">{{ __('Edit') }}</a>
                                    @if ($user->deleted_at)
                                        <button class="btn btn-secondary m-btn m-btn--custom btn-sm btn-restore" type="button" data-id="{{ $user->id }}" data-url="{{ route('users.restore', $user->id) }}">Restore</button>
                                    @else
                                        @if(Auth::id() !== $user->id)
                                        <button class="btn btn-sm btn-danger m-btn m-btn--custom btn-delete" type="button" data-id="{{ $user->id }}" data-url="{{ route('users.destroy', $user->id) }}">{{ __('Delete') }}</button>
                                        @endif
                                    @endif
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

@section('css')
    <style>
        .m-datatable__lock--right{
            overflow: visible !important;
        }
    </style>
@stop


@section('js')
    <script>
        const UsersTable = function() {
            var users = function() {

                var datatable = $('#users').mDatatable({
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
                        autoHide: true,
                    },
                    sortable: true,
                    filterable: false,
                    pagination: true,
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
                            field: 'JoinedAt',
                            type: 'date',
                            format: 'YYYY-MM-DD',
                        }
                    ],
                });

                datatable.on('click', '.btn-delete', function(e){
                    e.preventDefault();
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You may not be able to undo this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                    url: url,
                                    type: 'delete',
                                    data: {
                                        "id": id,
                                        "_token": token
                                    }
                                })
                                    .done(function(response){
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: response.message,
                                            onClose: function() {
                                                window.location.href = response.url;
                                            }
                                        })
                                    })
                                    .fail(function(){
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            });
                        },
                        allowOutsideClick: false
                    })
                });
                datatable.on('click', '.btn-restore', function(e){
                    e.preventDefault();
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: 'Are you sure?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore entry!',
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                        "id": id,
                                        "_token": token
                                    }
                                })
                                    .done(function(response){
                                        Swal.fire({
                                            title: 'Restored!',
                                            text: response.message,
                                            onClose: function() {
                                                window.location.href = response.url;
                                            }
                                        })
                                    })
                                    .fail(function(){
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            });
                        },
                        allowOutsideClick: false
                    })
                });

                $('#m_form_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#m_form_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Role');
                });

                $('#m_form_status, #m_form_type').selectpicker();

            };
            return {
                //== Public functions
                init: function() {
                    // init users
                    users();
                },
            };
        }();
        const LoadTypes = function(){
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
                    types();
                }
            }
        }();

        jQuery(document).ready(function() {
            LoadTypes.init();
            UsersTable.init();
        });

    </script>
@endsection

