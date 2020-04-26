@extends('layouts.master')

@section('title', 'Districts')

@section('content')
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Districts') }}
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
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('districts.create') }}" class="btn btn-primary m-btn m-btn--wide m-btn--air btn-block btn-sm">Add New District</a>
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
                        <table class="m_datatable" id="districts">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="Email">{{ __('Email') }}</th>
                                <th data-field="Contact Number">{{ __('Contact Number') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($districts as $district)
                                <tr>
                                    <td>{{ $district->id }}</td>
                                    <td>{{ $district->name }}</td>
                                    <td>
                                        {{$district->email}}
                                    </td>
                                    <td>{{ $district->contact_number }}</td>
                                    <td>
                                        <a href="{{ route('districts.edit', $district->id) }}" data-toggle="m-tooltip" title="Edit District" data-placement="left" data-original-title="Edit District" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <a href="{{ route('districts.show', $district->id) }}" data-toggle="m-tooltip" title="View District" data-placement="left" data-original-title="View District" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>
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
                field: 'email',
                type: 'text',
                width: 150
            },
            {
                field: 'contact_number',
                title: 'Contact Number',
                type: 'text',
                width: 150
            },
            {
                field: 'actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
            }
        ];
        jQuery(document).ready(function() {

            TableElement.init($('#districts'), columns);
        });

    </script>
@endsection

@section('css')

@endsection

