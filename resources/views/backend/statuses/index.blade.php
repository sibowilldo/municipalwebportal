@extends('layouts.master')


@section('title', 'Statuses')
@section('breadcrumbs', Breadcrumbs::render('statuses.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Statuses') }}
                            </h3>
                        </div>
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
                                        <div class="col-md-6">
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
                                    <a href="{{ route('statuses.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--sm">
                                    <span>
                                        <span>{{ __('Create Status') }}</span>
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
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="Active">{{ __('Active') }}</th>
                                <th data-field="State Color">{{ __('State Color') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>
                                        <div class="font-weight-bold">
                                            {{ $status->name }}
                                        </div>
                                        <div class="text-muted">{{$model_types[$status->model_type]}}</div></td>
                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--rounded m-badge--{{ $status->is_active ? 'success' : 'danger' }}">{{ $status->is_active? 'Active':'Inactive'  }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="m-badge m-badge--dot-small m-badge--{{ $colors->where('id', $status->state_color_id)->first()->css_class }}"></span>
                                            {{ Str::title($colors->where('id', $status->state_color_id)->first()->name) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('statuses.edit', $status->id) }}" data-toggle="m-tooltip" title="Edit Status" data-placement="left" data-original-title="Edit Status" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <a href="{{ route('statuses.show', $status->id) }}" data-toggle="m-tooltip" title="View Status" data-placement="left" data-original-title="View Status" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>
                                    </td>
                                    <td>{{ $status->description }}</td>
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
                width: 350
            },
            {
                field: 'Active',
                title: 'Active',
                autoHide: true,
                align: 'center'
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

            TableElement.init($('#types'), columns);
        });

    </script>
@endsection
