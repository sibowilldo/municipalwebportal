@extends('layouts.master')


@section('title', 'Types')
@section('breadcrumbs', Breadcrumbs::render('types.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Types') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-dark m-btn--hover-dark">
                                        Quick Actions
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
                                                            <a href="{{ route('categories.index') }}" class="m-nav__link">
                                                                {{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
                                                                <span class="m-nav__link-text">All Categories</span>
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
                                    <a href="{{ route('types.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Add New Type') }}</span>
                                    </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <table class="m_datatable" id="types">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="name">{{ __('Name') }}</th>
                                <th data-field="stateColor">{{ __('State Color') }}</th>
                                <th data-field="actions">{{ __('Actions') }}</th>
                                <th data-field="description">{{ __('Description') }}</th>
                                <th data-field="associatedCategories">{{ __('Associated Categories') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--dot m-badge--dot-small m-badge--{{ $type->state_color->css_class }}"></span>
                                            {{ title_case($type->state_color->name) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('types.edit', $type->id) }}" data-toggle="m-tooltip" title="Edit Type" data-placement="left" data-original-title="Edit Type" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <a href="{{ route('types.show', $type->id) }}" data-toggle="m-tooltip" title="View Type" data-placement="left" data-original-title="View Type" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>
                                    </td>
                                    <td>{{ $type->description }}</td>
                                    <td>
                                        @foreach($type->categories as $category)
                                            <a href="{{ route('categories.show', $category->id) }}" class="m-badge m-badge--brand m-badge--wide mb-2">{{ ucwords($category->name ) }}</a>
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
                field: 'name',
                title: 'Name',
                type: 'text',
                width: 150
            },
            {
                field: 'description',
                title: 'Description',
                type: 'text',
                autoHide: true,
                width: 350
            },
            {
                field: 'active',
                title: 'Active',
                autoHide: true
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                locked: {right: 'lg'},
                overflow: 'visible',
            }
        ];
        jQuery(document).ready(function() {

            TableElement.init($('#types'), columns);
        });

    </script>
@endsection
