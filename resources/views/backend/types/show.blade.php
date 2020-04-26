@extends('layouts.master')


@section('title', 'Types')
@section('breadcrumbs', Breadcrumbs::render('types.show', $type))

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="m-portlet m-portlet--mobile m-form">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ $type->name }} {{ __(' Details') }}
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
                                                        <a href="{{ route('types.create') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-plus-square"></i>
                                                            <span class="m-nav__link-text">Add Type</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('types.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list-alt"></i>
                                                            <span class="m-nav__link-text">All Types</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('categories.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-folder-open"></i>
                                                            <span class="m-nav__link-text">All Categories</span>
                                                        </a>
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
                                {{ $type->id }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Name:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $type->name }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Description:
                            </span>
                            <span class="m-widget13__text">
                                {{ $type->description }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Active:
                            </span>
                            <span class="m-widget13__text m-widget13__text-bolder">
                                {{ $type->is_active ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                Associated Categories:
                            </span>
                            <span class="m-widget13__text">
                            @foreach($type->categories  as $category)
                                    <a href="{{ route('categories.show', $category->id) }}" class="m-badge m-badge--brand m-badge--wide">{{ ucwords($category->name ) }}</a>
                            @endforeach
                            </span>
                        </div>
                        <div class="m-widget13__item">
                            <span class="m-widget13__desc m--align-right">
                                State Color:
                            </span>
                            <span class="m-widget13__text">
                            <span class="m-badge m-badge--{{ $type->state_color->css_class }}"></span>  {{ title_case($type->state_color->name) }}
                            </span>
                        </div>
                    </div>
                </div>

                @include('layouts.portlets.footer._footer', [
                        'type'=> 'show',
                        'name' => 'Type',
                        'id' => $type->id,
                        'edit_url' => route('types.edit', $type->id),
                        'delete_url' => route('types.destroy', $type->id)])
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
                            .fail(function(ex){
                                Swal.fire('Oops...', ex.responseJSON.message, 'error');
                            });
                        });
                    },
                    allowOutsideClick: false
                })
            });
        });
    </script>
@endsection
