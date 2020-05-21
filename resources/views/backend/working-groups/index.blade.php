@extends('layouts.master')


@section('title', 'Working Groups')
@section('breadcrumbs', Breadcrumbs::render('working-groups.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Working Groups') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
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
                                        <div class="col-md-8">
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
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('working-groups.create') }}"
                                       class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--sm">
                                    <span>
                                        <span>{{ __('Create Working Group') }}</span>
                                    </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form -->
                        <table class="m_datatable" id="working_groups">
                            <thead>
                            <tr>
                                <th data-field="id">{{ __('#') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="State">{{ __(' State') }}</th>
                                <th data-field="Leader">{{ __('Leader') }}</th>
                                <th data-field="NoOfMembers">{{ __('# of Members') }}</th>
                                <th data-field="Actions">{{ __('Quick Actions') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($working_groups as $working_group)
                                <tr>
                                    <td>{{ $working_group->id }}</td>
                                    <td>{{ $working_group->name }}</td>
                                    <td>
                                        <span>

                                        <span
                                            class="m-badge  m-badge--dot shadow m-badge--{{ $working_group->is_active ? 'success' : 'light' }} m-badge--wide"></span>
                                        &nbsp;<span class="m--font-bold">{{ $working_group->is_active ? 'Active' : 'Inactive' }}</span>
                                        </span>

                                    </td>
                                    <td>
                                        {{ $working_group->users()->where('is_leader', true)->first() ? $working_group->users()->where('is_leader', true)->first()->fullname:'No Leader Assigned' }}
                                    </td>
                                    <td>
                                        {{ $working_group->users->count() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('working-group.list', $working_group->id) }}"
                                           data-toggle="m-tooltip" title="Assign Engineers" data-placement="left"
                                           data-original-title="Assign Engineers"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-user-plus"></i></a>
                                        <a href="{{ route('working-groups.edit', $working_group->id) }}"
                                           data-toggle="m-tooltip" title="Edit Working Group" data-placement="left"
                                           data-original-title="Edit Working Group"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-edit"></i></a>
                                        <a href="{{ route('working-groups.show', $working_group->id) }}"
                                           data-toggle="m-tooltip" title="View Working Group" data-placement="left"
                                           data-original-title="View Working Group"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                class="la la-eye"></i></a>
                                        <button type="button"
                                                class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-delete"
                                                data-id="{{ $working_group->id }}"
                                                data-url="{{ route('working-groups.destroy', $working_group->id) }}"><i
                                                class="la la-trash-o"></i></button>
                                    </td>
                                    <td>{{ $working_group->description }}</td>
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
        const TableMethods = function () {
            return {
                init: function (datatable) {

                }
            }
        }();
        const columns = [
            {
                field: 'id',
                title: '#',
                type: 'number',
                width: 40
            },
            {
                field: 'Name',
                title: 'Name',
                type: 'text',
                width: 200
            },
            {
                field: 'NoOfMembers',
                title: '# of Members',
                sortable: true,
                width: 150,
                autoHide: false
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 150,
                overflow: 'visible',
            },
            {
                field: 'State',
                title: 'State',
                sortable: false,
                width: 150,
                autoHide: true
            },
            {
                field: 'Description',
                title: 'Description',
                type: 'text',
                autoHide: true,
                width: 350
            }
        ];
        jQuery(document).ready(function () {

            TableElement.init($('#working_groups'), columns);
        });

    </script>
@endsection
