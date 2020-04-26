@extends('layouts.master')


@section('title', 'Working Group')
@section('breadcrumbs', Breadcrumbs::render('working-groups.show', $working_group))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile m-form m-form--fit">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ $working_group->name }}
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
                                                    @if($working_group->users()->count() <  6)
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('working-group.list', $working_group->id) }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-user-plus"></i>
                                                            <span class="m-nav__link-text">Assign Engineers</span>
                                                        </a>
                                                    </li>
                                                    @else
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link">
                                                                <i class="m-nav__link-icon la la-user-plus"></i>
                                                                <span class="m-nav__link-text">Maximum # of Engineers reached for this group</span>
                                                            </a>
                                                        </li>
                                                    @endif
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
                                {{ $working_group->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $working_group->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Description:
                            </span>
                            <span class="m-widget13__text">
                                {{ $working_group->description }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Active:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $working_group->is_active ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Assigned Engineers:
                            </span>
                            <span class="m-widget13__text">
                                    @if(count($working_group->users))
                                    <div class="m-list-timeline">
                                        <div class="m-list-timeline__items">
                                            @foreach($working_group->users as $user)
                                                    <div class="m-list-timeline__item">
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--{{ $user->pivot->is_leader ? 'success':'warning' }}"></span>
                                                        <span class="m-list-timeline__icon la la-user{{ $user->pivot->is_leader ? '-secret':'' }}"></span>
                                                        <span class="m-list-timeline__text">{{$user->fullname}}</span>
                                                        <span class="m-list-timeline__time">{{ $user->pivot->is_leader ? 'Leader':'' }}</span>
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
                    'name' => 'Type',
                    'id' => $working_group->id,
                    'edit_url' => route('working-groups.edit', $working_group->id),
                    'delete_url' => route('working-groups.destroy', $working_group->id)])
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
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete group!',
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
