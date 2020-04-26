@extends('layouts.master')


@section('title', 'State Color')
@section('breadcrumbs', Breadcrumbs::render('state-colors.show', $state_color))

@section('content')

    <div class="row">
        <div class="col-xl-4 offset-xl-4">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded m-form">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('State Color Details') }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget13">
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                 #
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $state_color->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $state_color->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                CSS Class:
                            </span>
                            <span class="m-widget13__text">
                                {{ $state_color->css_class }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                CSS Color:
                            </span>
                            <span class="m-widget13__text">
                                {{ $state_color->css_color }}
                            </span>
                        </div>
                    </div>
                </div>
                @include('layouts.portlets.footer._footer', [
                        'type'=> 'show',
                        'name' => 'Color',
                        'id' => $state_color->id,
                        'edit_url' => route('state-colors.edit', $state_color->id),
                        'delete_url' => route('state-colors.destroy', $state_color->id)])
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
