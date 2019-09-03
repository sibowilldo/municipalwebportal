@extends('layouts.master')


@section('title', 'Working Group')
@section('breadcrumbs', Breadcrumbs::render('working-groups.show', $working_group))

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile ">
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
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                        <span class="m-list-timeline__icon fa fa-user{{ $user->pivot->is_leader ? '-tie':'' }}"></span>
                                                        <span class="m-list-timeline__text">{{$user->fullname}}</span>
                                                        <span class="m-list-timeline__time">{{ $user->pivot->is_leader ? 'Leader':'' }}</span>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                            </span>
                        </div>
                        <div class="m-widget13__action m--align-right">
                            <a href="{{ route('working-groups.edit', $working_group->id) }}" class="m-widget__details  btn m-btn--pill  btn-accent">Edit Details</a>
                            <button type="button" class="btn m-btn--pill btn-danger btn-delete"  data-id="{{ $working_group->id }}" data-url="{{ route('working-groups.destroy', $working_group->id) }}">Remove</button>
                        </div>
                    </div>
                </div>
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
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You may not be able to undo this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
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
                                    swal('Oops...', 'Something went wrong with ajax !', 'error');
                                });
                        });
                    },
                    allowOutsideClick: false
                })
            });
        });
    </script>
@endsection
