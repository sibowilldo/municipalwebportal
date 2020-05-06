@extends('layouts.master')


@section('title', 'Departments')
@section('breadcrumbs', Breadcrumbs::render('departments.index'))

@section('content')

    <div class="row">
        <div class="col-xl-10 offset-xl-1">
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
                                                        <a href="{{ route('departments.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list"></i>
                                                            <span class="m-nav__link-text">View Departments</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('users.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-users"></i>
                                                            <span class="m-nav__link-text">View Users</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('departments.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--wide btn-sm">Add Department</a>
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

                    <!--begin: Datatable -->
                    <div class="m_datatable">
                        <!--begin: Search Form -->
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-xl-8 order-2 order-xl-1">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4 pt-3">
                                            <label for="status_id">Search Phrase</label>
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input m-input--square" placeholder="Search..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="category_id">Category</label>
                                            {!! Form::select('category_id', array_merge([null => 'Select Category'], $categories->toArray()), null, ['id'=>'category_id', 'class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
                                        </div>
                                        <div class="col-md-4">
                                            <label for="status_id">Status</label>
                                            {!! Form::select('status_id', array_merge([null => 'Select Status'], $statuses->toArray()) , null, ['id'=>'status_id', 'class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
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
                                <th data-field="name">{{ __('Name') }}</th>
                                <th data-field="district">{{ __('District') }}</th>
                                <th data-field="contact_number">{{ __('Contact Number') }}</th>
                                <th data-field="email">{{ __('Email') }}</th>
                                <th data-field="status">{{ __('Status') }}</th>
                                <th data-field="category">{{ __('Category') }}</th>
                                <th data-field="address">{{ __('Address') }}</th>
                                <th data-field="description">{{ __('Description') }}</th>
                                <th data-field="actions">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td><a href="{{ route('districts.show', $department->district()->withTrashed()->first()->id) }}" class="m-link m-link--danger">{{ $department->district()->withTrashed()->first()->name }}</a>  </td>
                                    <td>{{ $department->contact_number }}</td>
                                    <td><a href="mailto:{{ $department->email }}" class="m-link m-link--primary">{{ $department->email }}</a></td>

                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--dot-small m-badge--{{ $department->status->state_color->css_class }}"></span>
                                            {{ Str::title($department->status->name) }}
                                        </span>
                                    </td>
                                    <td>{{ $department->category->name }}</td>
                                    <td>{{ $department->address }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>

                                        <a href="{{ route('departments.edit', $department->id) }}" data-toggle="m-tooltip"
                                           title="Edit Department" data-placement="left" data-original-title="Edit Department"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-edit"></i></a>
                                        <a href="{{ route('departments.show', $department->id) }}" data-toggle="m-tooltip"
                                           title="Edit Department" data-placement="left" data-original-title="Edit Department"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-eye"></i></a>
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
        const columns = [
            {
                field: 'id',
                title: '#',
                type: 'number',
                width: 25
            },
            {
                field: 'name',
                title: 'Name',
                type: 'text'
            },
            {
                field: 'district',
                title: 'District',
                type: 'text',
            },
            {
                field: 'contact_number',
                title: 'Contact Number',
                type: 'text',
            },
            {
                field: 'email',
                title: 'Email',
                type: 'text',
            },
            {
                field: 'category',
                title: 'Category',
                type: 'text',
                autoHide: true,
            },
            {
                field: 'status',
                title: 'Status',
                autoHide: true
            },
            {
                field: 'description',
                title: 'Description',
                width: 600,
                autoHide: true
            },
            {
                field: 'address',
                title: 'Address',
                type: 'text',
                width: 300,
                autoHide: true
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                width: 200,
                overflow: 'visible',
                locked: {right: 'lg'}
            }
        ];
        const SetupDepartments = function(){
            let departments = function(){

                var datatable = $('#departments').mDatatable({
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
                    columns: columns
                });

                $('#category_id').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'category');
                });

                $('#status_id').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });


                $('#status_id, #category_id').selectpicker();
            };

            return{
                init:function(){
                    departments();
                }
            }
        }();
        jQuery(document).ready(function() {
            SetupDepartments.init();
        });

    </script>
@endsection
