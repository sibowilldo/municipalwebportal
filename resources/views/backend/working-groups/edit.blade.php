@extends('layouts.master')

@section('title', 'Working Group')
@section('breadcrumbs', Breadcrumbs::render('working-groups.edit', $working_group))

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

				{!! Form::model($working_group, ['route'=> ['working-groups.update', $working_group->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right']) !!}
				@include('backend.working-groups._form')

				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-md-10 offset-md-2">
								<button type="submit" class="btn btn-success m-btn--pill m-btn--air">Update Details</button>
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

@endsection
