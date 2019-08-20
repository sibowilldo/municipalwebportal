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
				@include('layouts.form-errors')
				{!! Form::open(['route'=> 'state-colors.store', 'method'=>'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				@include('backend.state_colors._form')

				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-md-10 offset-md-2">
								<button type="submit" class="btn btn-success m-btn--pill m-btn--air">Add Color</button>
								<button type="reset" class="btn btn-secondary m-btn--pill m-btn--air">Reset Form</button>
							</div>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script>
		jQuery(document).ready(function() {

		});

	</script>
@endsection
