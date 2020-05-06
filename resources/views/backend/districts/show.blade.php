@extends('layouts.master')

@section('title', 'Districts')
@section('breadcrumbs', Breadcrumbs::render('districts.show', $district))

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded m-form">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ $district->name }} {{ __(' Details') }}
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
                                                        <a href="{{ route('districts.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-map-marker"></i>
                                                            <span class="m-nav__link-text">View Districts</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('statuses.index') }}" class="m-nav__link">
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
                    <div class="m-widget13">
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                 #
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $district->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $district->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Email:
                            </span>
                            <span class="m-widget13__text">
                                {{ $district->email }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Contact Number:
                            </span>
                            <span class="m-widget13__text">
                                {{ $district->contact_number }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Created on:
                            </span>
                            <span class="m-widget13__text">
                             {{ Carbon::parse($district->created_at)->format('d M yy, h:m:s') }}
                            </span>
                        </div>

                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Departments:
                            </span>
                            <span class="m-widget13__text">
                                    @if(count($district->departments))
                                    <div class="m-list-timeline">
                                        <div class="m-list-timeline__items">
                                            @foreach($district->departments as $department)
                                                <div class="m-list-timeline__item">
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
                                                        <span class="m-list-timeline__icon la la-bookmark"></span>
                                                        <span class="m-list-timeline__text">{{$department->name}}</span>
                                                        <span class="m-list-timeline__time" style="width: 90px;">{{ $department->contact_number }}</span>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @include('layouts.portlets.footer._footer', [
                    'type'=> 'show',
                    'name' => 'District',
                    'id' => $district->id,
                    'edit_url' => route('districts.edit', $district->id),
                    'delete_url' => route('districts.destroy', $district->id)])
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        jQuery(document).ready(function() {
            $('.btn-delete').on('click', function(e){
                e.preventDefault();
                var id = $(this).data("id");
                var url = $(this).data("url");
                var token = $("meta[name='csrf-token']").attr("content");
                swalDelete.fire({
                    title: 'Are you sure?',
                    text: "You may not be able to undo this!",
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
                                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                                });
                        });
                    },
                    allowOutsideClick: false
                })
            });
        });
    </script>
@endsection

@section('css')

@endsection

