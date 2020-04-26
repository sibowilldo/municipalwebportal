@extends('layouts.master')

@section('title', 'State Colors')
@section('breadcrumbs', Breadcrumbs::render('state-colors.create'))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
			<div class="m-portlet m-portlet--mobile  m-portlet--rounded">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('State Color Details') }}
							</h3>
						</div>
					</div>
				</div>
				{!! Form::open(['route'=> 'state-colors.store', 'method'=>'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				@include('backend.state_colors._form')
                @include('layouts.portlets.footer._footer', ['type'=> 'create', 'name' => 'Color'])

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script>
        jQuery(document).ready(function() {
            $('.m-input.color-picker').colorpicker({
                extensions: [
                    {
                        name: 'swatches', // extension name to load
                        options: { // extension options
                            colors: {
                                'primary': '#007bff',
                                'secondary': '#6c757d',
                                'success': '#28a745',
                                'info': '#17a2b8',
                                'warning': '#ffc107',
                                'danger': '#dc3545',
                                'light': '#f8f9fa',
                                'dark': '#343a40',
                                'blue': '#007bff',
                                'indigo': '#6610f2',
                                'purple': '#6f42c1',
                                'pink': '#e83e8c',
                                'red': '#dc3545',
                                'orange': '#fd7e14',
                                'yellow': '#ffc107',
                                'green': '#28a745',
                                'teal': '#20c997',
                                'cyan': '#17a2b8',
                                'white': '#fff',
                                'gray': '#6c757d',
                                'gray-dark': '#343a40',
                            },
                            namesAsValues: false
                        }
                    }
                ]
            });
        });
	</script>
@endsection
