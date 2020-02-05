@extends('layouts.master')


@section('title', 'Available Engineers')
@section('breadcrumbs', Breadcrumbs::render('working-groups.index'))

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--mobile m-portlet--full-height">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Available Engineers') }}
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
                                                <input type="text" class="form-control m-input form-control-lg" placeholder="Search..."
                                                       id="generalSearch">
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
                        <table class="m_datatable" id="engineers">
                            <thead>
                                <tr>
                                    <th data-field="id">{{ __('#') }}</th>
                                    <th data-field="Name">{{ __('Name') }}</th>
                                    <th data-field="Status">{{ __(' Status') }}</th>
                                    <th data-field="Roles">{{ __('Roles') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($engineers as $engineer)
                                <tr>
                                    <td>{{ $engineer->uuid }}</td>
                                    <td>
                                        <div>
                                            <div class="m-card-user">
                                                <div class="m-card-user__pic">
                                                    <img
                                                        src="{{ Avatar::create($engineer->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 40])}}"
                                                        class="m--img-rounded m--marginless"/>
                                                </div>
                                                <div class="m-card-user__details"><span
                                                        class="m-card-user__name m--regular-font-size-lg1">{{ $engineer->fullname }}</span>
                                                    <a class="m-card-user__email m-link m--regular-font-size-sm1"
                                                       href="mailto:{{ $engineer->email }}">{{ $engineer->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>

                                        <span
                                            class="m-badge  m-badge--dot shadow m-badge--dark m-badge--wide"></span>
                                        &nbsp;<span class="m--font-bold">{{ $engineer->status->name }}</span>
                                        </span>

                                    </td>
                                    <td> {{ implode(', ', $engineer->roles()->pluck('name')->toArray())}}
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
        <div class="col-xl-4">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Working Group Details') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                        </ul>
                    </div>
                </div>
                {!! Form::open(['route' => ['working-group.assign', $working_group->id], 'method' => 'post']) !!}
                {!! Form::hidden('selectedEngineers',null, ['id' => 'selectedEngineers']) !!}
                <div class="m-portlet__body">
                    <div class="m-widget1__item mb-3">
                        <div class="m-widget4__info">
                            <div class="m-card-profile">
                                <div class="m-card-profile__title m--hide">
                                    Your Profile
                                </div>
                                <div class="m-card-profile__pic">
                                    <div class="m-card-profile__pic-wrapper m-0">
                                        <img src="{{ Avatar::create($leader->email)->toGravatar(['d' => 'mp', 'r' => 'pg', 's' => 40])}}" alt="">
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name">{{ $leader->fullname }}</span>
                                    <p class="m-card-profile__details text-uppercase">Group Superintendent</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item mb-3">
                        <div class="m-widget4__info">
                            <h6 class="m-widget4__title m--font-boldest">Group Name</h6>
                            <p class="m-widget4__sub text-md-right">{{ $working_group->name }}</p>
                        </div>
                    </div>
                    <div class="m-widget1__item mb-3">
                        <div class="m-widget4__info">
                            <h6 class="m-widget4__title m--font-boldest">Description</h6>
                            <p class="m-widget4__sub text-md-right">{{ $working_group->description }}</p>
                        </div>
                    </div>
                    <div class="m-widget1__item  mb-3">
                        <div class="m-widget4__info">
                            <h6 class="m-widget4__title m--font-boldest">Active</h6>
                            <p class="m-widget4__sub text-md-right">{{ $working_group->is_active?'Yes':'No' }}</p>
                        </div>
                    </div>
                    <div class="m-widget1__item mb-3">
                        <div class="m-widget4__info">
                            <h6 class="m-widget4__title m--font-boldest">Status</h6>
                            <p class="m-widget4__sub text-md-right">{{ ucfirst($working_group->status->name) }}</p>
                        </div>
                    </div>
                    <div class="m-widget1__item mb-3">
                        <div class="m-widget4__info">
                            <label for="instructions" class="m-widget4__title m--font-boldest">Group Instructions</label>
                            <p class="m-widget4__sub text-md-right">{{ Form::textarea('instructions', null, ['class'=>'form-control']) }}</p>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit m-form m-form--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <button class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill pull-right" type="submit">
                            <span><i class="la la-check"></i><span> Save Changes</span></span>
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

@endsection

@section('js')
    <script>
        const EngineerList = function () {
            var options = {
                layout: {
                    height: 550,
                    scroll: true
                },
                search: {
                    input: $('#generalSearch')
                },
                sortable: true,
                pagination: true,
                columns: [
                    {
                        field: "id",
                        title: "#",
                        width: 50,
                        sortable: false,
                        textAlign: 'center',
                        selector: {class: 'selected-engineer'}
                    },
                    {
                        field: 'Name',
                        title: 'Name',
                        sortable: false,
                        type: 'text',
                        width: 250
                    },
                    {
                        field: 'Status',
                        title: 'Status',
                        sortable: true
                    },
                    {
                        field: 'Roles',
                        title: 'Roles',
                        sortable: true,
                        overflow: 'visible',
                    }]
            };

            var fx = function () {
                options.search = {};
                var datatable = $('#engineers').mDatatable(options);
                datatable.on('m-datatable--on-check m-datatable--on-uncheck m-datatable--on-layout-updated', function (a, e) {
                    var checkedNodes = datatable.rows('.m-datatable__row--active').nodes();
                    var checkedItems = checkedNodes.find('.m-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                        return $(chk).val();
                    }).toArray();
                    var count = $(checkedItems).length;
                    if (count> 5) {
                        var theChk = $(checkedNodes[count - 1]).find('.m-checkbox--single > [type="checkbox"]');

                        $(theChk).prop('checked', false);
                        $(checkedNodes[count - 1]).removeClass('m-datatable__row--active');
                        checkedItems.pop();
                        Swal.fire({
                            icon: 'danger',
                            title: 'Oops! Maximum selection reached.',
                            text: 'You can only select at a maximum of 5 engineers at one time.',
                            backdrop: "#00000033"
                        });
                    }

                    $("#selectedEngineers").val(checkedItems);
                });
            };

            return {
                init: function () {
                    fx();
                }
            }
        }();
        jQuery(document).ready(function () {
            EngineerList.init();
        });

    </script>
@endsection



@section('css')
    <style>
        .m-checkbox--all {
            display: none !important;
            visibility: hidden !important;
        }
    </style>
@stop
