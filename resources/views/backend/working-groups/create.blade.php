@extends('layouts.master')

@section('title', 'Working Group')
@section('breadcrumbs', Breadcrumbs::render('working-groups.create'))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
			<div class="m-portlet m-portlet--mobile  m-portlet--rounded">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('Working Group Details') }}
							</h3>
						</div>
					</div>
					<div class="m-portlet__head-tools">
						<ul class="m-portlet__nav">
						</ul>
					</div>
				</div>
				@include('layouts.form-errors')
				{!! Form::open(['route'=> 'working-groups.store', 'method'=>'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				@include('backend.working-groups._form')

				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
                        <button type="reset" class="btn m-btn--pill btn-light  m-btn pull-left m-btn--custom">Reset Form</button>
                        <button type="submit" class="btn btn-success m-btn--pill pull-right m-btn--icon m-btn--custom"><span><i class="la la-check"></i> <span>Save Working Group</span></span></button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
