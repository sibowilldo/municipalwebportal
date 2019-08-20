@extends('layouts.master')

@section('title', 'Categories')
@section('breadcrumbs', Breadcrumbs::render('categories.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Categories') }}
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
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Add New Category') }}</span>
                                    </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>

                        <!--end: Search Form -->
                        <table class="m_datatable" id="categories">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="Active">{{ __('Active') }}</th>
                                <th data-field="State Color">{{ __('State Color') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                                <th data-field="Associated Types">{{ __('Associated Types') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <span class="m-switch with-icon m-switch--icon m-switch--outline m-switch--success">
                                            <label>
                                                <input type="checkbox" disabled name="" {{ $category->is_active ? 'checked' : '' }}>
                                                <span></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td>
                                        <span>

                                        <span class="m-badge m-badge--{{ $category->state_color->css_class }}"></span>  {{ title_case($category->state_color->name) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" data-toggle="m-tooltip" title="Edit Category" data-placement="left" data-original-title="Edit Category" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <a href="{{ route('categories.show', $category->id) }}" data-toggle="m-tooltip" title="View Category" data-placement="left" data-original-title="View Category" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>
                                    </td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        @foreach($category->types as $type)
                                            <a href="{{ route('types.show', $type->id) }}" class="m-badge m-badge--brand m-badge--wide mb-2">{{ ucwords($type->name ) }}</a>
                                        @endforeach
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
                field: 'Name',
                title: 'Name',
                type: 'text',
                width: 150
            },
            {
                field: 'Description',
                title: 'Description',
                type: 'text',
                autoHide: true,
                width: 300
            },
            {
                field: 'Active',
                title: 'Active',
                autoHide: true,
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 150,
                overflow: 'visible'
            },
            {
                field: 'Associated Types',
                title: 'Associated Types',
                sortable: false,
                width: 350
            }
        ];
        jQuery(document).ready(function() {

            TableElement.init($('#categories'), columns);
        });

    </script>
@endsection
