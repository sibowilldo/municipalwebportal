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
				{!! Form::open(['route'=> 'working-groups.store', 'method'=>'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				    @include('backend.working-groups._form')
                    @include('layouts.portlets.footer._footer', ['type'=> 'create', 'name' => 'Group'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
