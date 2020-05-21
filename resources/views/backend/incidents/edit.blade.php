@extends('layouts.master')

@section('title', 'Incidents')
@section('breadcrumbs', Breadcrumbs::render('incidents.edit', $incident))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
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
                                                        <a href="{{ route('incidents.show', $incident->id) }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list"></i>
                                                            <span class="m-nav__link-text">View Details</span>
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
							<div class="col-md-12">
                                <button class="btn btn-outline-light-inverse m-btn m-btn--icon m-btn--custom m-btn--hover-danger"
                                        type="button" data-toggle="modal" data-target="#delete_modal">
                                    <span>
                                        <i class="la la-trash"></i>
                                        <span>Trash </span>
                                    </span>
                                </button>
								<button type="submit" class="btn btn-success pull-right m-btn--icon m-btn--custom"><span><i
                                            class="la la-check"></i><span>Update Incident</span></span></button>
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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAvIMlJTlLmGJL26pLPydvDX0eKduvnXag&callback=initAutocomplete" async defer></script>
    <script>
        var placeSearch, autocomplete;

        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('location_description'), {types: ['geocode']});

            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            autocomplete.setFields(['geometry']);

            // Set initial restrict to the greater list of countries.
            autocomplete.setComponentRestrictions(
                {'country': ['za']});

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
            console.log()
            $('input[name=longitude]').val(place.geometry.location.lng())
            $('input[name=latitude]').val(place.geometry.location.lat())
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle(
                        {center: geolocation, radius: position.coords.accuracy});
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

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
                                let typeSelect = $('select[name="type_id"]');
                                typeSelect.empty();
                                $.each(data.data, function(key, value){
                                    typeSelect.append('<option value="'+ key +'">' + value + '</option>').selectpicker('refresh');

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
                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
            });
            LoadTypes.init();

            //Handle Form Validation
            $.validate({
                modules : 'location, security'
            });
            $('#description').restrictLength( $('#desc-max-length') );
            $('#delete_reason').restrictLength( $('#delete_reason-max-length') );
        });
	</script>
@endsection
