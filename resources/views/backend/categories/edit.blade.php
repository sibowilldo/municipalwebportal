@extends('layouts.master')

@section('title', 'Categories')
@section('breadcrumbs', Breadcrumbs::render('categories.edit', $category))

@section('content')

	<div class="row">
		<div class="col-xl-6 offset-xl-3">
			<div class="m-portlet m-portlet--mobile">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('Category Details') }}
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
                                                        <a href="{{ route('categories.create') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-plus-square"></i>
                                                            <span class="m-nav__link-text">Add Category</span>
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

				{!! Form::model($category, ['route'=> ['categories.update', $category->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				@include('backend.categories._form')

                @include('layouts.portlets.footer._footer', ['type'=> 'edit', 'name' => 'Category'])
				{!! Form::close() !!}
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
                    cancelButtonClass: "btn btn-light m-btn m-btn--custom",
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
                                .fail(function(response){
                                    swal(response.responseJSON.title ? response.responseJSON.title : 'Oops...', response.responseJSON.message ? response.responseJSON.message : 'Something went wrong with ajax !<br>', 'error');
                                });
                        });
                    },
                    allowOutsideClick: false
                })
            });
        });
    </script>
@endsection
