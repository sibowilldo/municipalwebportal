@extends('layouts.master')


@section('title', 'Assign Working Group')
@section('breadcrumbs', Breadcrumbs::render('incidents.groups', $incident))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Assign Working Group') }}
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
                                                <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('working-groups.create', ['payload'=>$incident->uuid]) }}" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('Create & Assign New Group') }}</span>
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
                                <th data-field="Leader">{{ __('Leader') }}</th>
                                <th data-field="# of Members">{{ __('# of Members') }}</th>
                                <th data-field="Name">{{ __('Name') }}</th>
                                <th data-field="Active">{{ __('Active') }}</th>
                                <th data-field="Actions">{{ __('Actions') }}</th>
                                <th data-field="Description">{{ __('Description') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $working_group)
                                <tr>
                                    <td>
                                        @if($working_group->users()->where('is_leader', true)->first())
                                            <div>
                                                <div class="m-card-user">
                                                    <div class="m-card-user__pic">
                                                        <img src="{{ Avatar::create($working_group->users()->where('is_leader', true)->first()->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 40])}}" class="m--img-rounded m--marginless" />
                                                    </div>
                                                    <div class="m-card-user__details"><span class="m-card-user__name m--regular-font-size-lg1">{{ $working_group->users()->where('is_leader', true)->first()->fullname }}</span>
                                                        <a class="m-card-user__email m-link m--regular-font-size-sm1" href="mailto:{{ $working_group->users()->where('is_leader', true)->first()->email }}">{{ $working_group->users()->where('is_leader', true)->first()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            'No Leader Assigned'
                                        @endif
                                    </td>
                                    <td>
                                        {{ count($working_group->users) }}
                                    </td>
                                    <td>{{ $working_group->name }}</td>
                                    <td>
                                        <i class="la {{ $working_group->is_active ? 'la-check' : 'la-close' }}"></i>
                                    </td>
                                    <td>
                                        <button type="button" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btn-danger btn-delete"  data-id="{{ $working_group->id }}" data-url="{{ route('working-groups.destroy', $working_group->id) }}"><i class="la la-trash-o"></i></button>
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
        const TableMethods = function(){
            return{
                init:function(datatable){

                }
            }
        }();
        const columns = [
            {
                field: 'Leader',
                title: 'Leader',
                width: 240
            },
            {
                field: '# of Members',
                title: '# of Members',
                type: 'number',
                width: 100
            },
            {
                field: 'Name',
                title: 'Name',
                type: 'text',
                width: 200
            },
            {
                field: 'Active',
                title: 'Active',
                sortable: false,
                width: 50,
                autoHide: true
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
            },
            {
                field: 'Description',
                title: 'Description',
                type: 'text',
                autoHide: true,
                width: 350
            }
        ];
        jQuery(document).ready(function() {
            TableElement.init($('#working_groups'), columns);
        });

    </script>
@endsection
