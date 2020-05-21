@extends('layouts.master')


@section('title', 'State Colors')
@section('breadcrumbs', Breadcrumbs::render('state-colors.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available State Colors') }}
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
                                        <div class="col-xl-6">
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
                                    <a href="{{ route('state-colors.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--sm">
                                    <span>
                                        <span>{{ __('Create State Color') }}</span>
                                    </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <table class="m_datatable" id="state_colors">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="CSS Class">{{ __('CSS Class') }}</th>
                                <th data-field="CSS Color">{{ __('CSS Color') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($state_colors as $state_color)
                                <tr>
                                    <td>{{ $state_color->id }}</td>
                                    <td>{{ $state_color->name }}</td>
                                    <td>{{ $state_color->css_class }}</td>
                                    <td>
                                        <span>
                                        <span class="m-badge m-badge--wide m-badge--{{ $state_color->css_class }}">{{ $state_color->css_color }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('state-colors.edit', $state_color->id) }}" data-toggle="m-tooltip" title="Edit Color" data-placement="left" data-original-title="Edit Color" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <a href="{{ route('state-colors.show', $state_color->id) }}" data-toggle="m-tooltip" title="View Color Details" data-placement="left" data-original-title="Edit Color Details" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>
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
                field: 'CSS Class',
                title: 'CSS Class',
                type: 'text',
                width: 150
            },
            {
                field: 'CSS Color',
                title: 'CSS Color',
                type: 'text',
                width: 150
            },
        ];
        jQuery(document).ready(function() {

            TableElement.init($('#state_colors'), columns);
        });

    </script>
@endsection
