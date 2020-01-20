@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.edit', $incident))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile m-portlet--rounded">
                <div class="m-portlet__body">
                    <incident-edit></incident-edit>
                </div>
            </div>

			<div class="m-portlet m-portlet--mobile  m-portlet--rounded">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('Incident Details') }}
							</h3>
						</div>
					</div>
					<div class="m-portlet__head-tools">
						<ul class="m-portlet__nav">
							<li class="m-portlet__nav-item">
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-ellipsis-h m--font-brand"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__section">
															<span class="m-nav__section-text">Useful Links</span>
														</li>
														<li class="m-nav__item">
															<a href="{{ route('incidents.show', $incident->id) }}" class="m-nav__link">
																<i class="m-nav__link-icon la la-list"></i>
																<span class="m-nav__link-text">View Details</span>
															</a>
														</li>
														{{--<li class="m-nav__item">--}}
															{{--<a href="{{ route('roles.index') }}" class="m-nav__link">--}}
																{{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
																{{--<span class="m-nav__link-text">Available Roles</span>--}}
															{{--</a>--}}
														{{--</li>--}}
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
                {!! Form::model($incident,
                    ['route'=> ['incidents.update', $incident->id],
                    'method'=>'PUT',
                    'class' => 'm-form m-form--fit m-form--label-align-right m-form--states',
                    'id' => 'editIncidentForm']) !!}
                <div class="m-portlet__body">
                    @include('layouts.form-errors')
				    @include('backend.incidents._form')
                </div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-success m-btn--pill">Update Details</button>
                                <button class="btn m-btn--pill btn-outline btn-outline-danger  m-btn m-btn--icon"
                                        type="button" data-toggle="modal" data-target="#delete_modal">
                                    <span>
                                        <i class="la la-trash"></i>
                                        <span>Trash </span>
                                    </span>
                                </button>
							</div>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

    @include('modals._delete-with-reason', ['id' => $incident->id, 'url' => route('incidents.destroy', $incident->id)])
@endsection

@section('js')
	<script>
        var LoadTypes = function(){
            var types = function(){
                $('select[name="category_id"]').on('change', function() {
                    var categoryId = $(this).val();
                    if(categoryId) {
                        $.ajax({
                            url: '/json/types/'+categoryId,
                            type:"GET",
                            dataType:"json",
                            beforeSend: function(){
                                $('#loader').css("visibility", "visible");
                            },
                            success:function(data) {
                                console.log(data.data);
                                $('select[name="type_id"]').empty();
                                $.each(data.data, function(key, value){
                                    $('select[name="type_id"]').append('<option value="'+ key +'">' + value + '</option>');

                                });
                            },
                            complete: function(){
                                $('#loader').css("visibility", "hidden");
                            }
                        });
                    } else {
                        $('select[name="type_id"]').empty();
                    }
                })
            };

            return {
                init: function(){
                    types()
                }
            }
        }();

        jQuery(document).ready(function() {
            //Handle Button Delete Click
            $('.btn-delete').on('click' , function(ev){
                var el = $(this);
                LoadDeleteFx.init(ev, el);
            });
            //Handle Delete Modal Actions
            $('.delete-modal').on('click' , function(ev){
                ev.preventDefault();
                var el = $(this);
                var id = el.data('id');
                var url = el.data('url');
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: url,
                    type: 'delete',
                    data: {
                        'id': id,
                        '_token': token
                    }
                })
                .done(function(response){
                    Swal.fire({
                        title: 'Deleted!',
                        text: response.message,
                        onClose: function() {
                            // window.location.href = response.url;
                        }
                    });
                })
                .fail(function(){
                    swal('Oops...', 'Something went wrong with ajax !', 'error');
                });
            });
            LoadTypes.init();
            $('#type_id').select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Choose a category from the list above first...'
                }
            });

            //Handle Form Validation
            $.validate({
                modules : 'location, security'
            });
            $('#description').restrictLength( $('#desc-max-length') );
            $('#delete_reason').restrictLength( $('#delete_reason-max-length') );
        });
	</script>
@endsection
