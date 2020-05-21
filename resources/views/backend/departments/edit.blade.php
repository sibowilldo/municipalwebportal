@extends('layouts.master')

@section('title', 'Departments')
@section('breadcrumbs', Breadcrumbs::render('departments.edit', $department))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
			<div class="m-portlet m-portlet--mobile  m-portlet--rounded">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('Department Details') }}
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
                                                        <a href="{{ route('departments.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list"></i>
                                                            <span class="m-nav__link-text">View Departments</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('districts.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-map-pin"></i>
                                                            <span class="m-nav__link-text">View Districts</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('users.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-users"></i>
                                                            <span class="m-nav__link-text">View Users</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('departments.create') }}" class="btn btn-primary m-btn m-btn--wide m-btn--air btn-block btn-sm">Add Department</a>
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

				{!! Form::model($department, ['route'=> ['departments.update', $department->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
                    @include('backend.departments._form')
                    @include('layouts.portlets.footer._footer', ['type'=> 'edit', 'name' => 'Department'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('js')
    <script>

        jQuery(document).ready(function(){
            $('input[type=tel]').inputmask('(999) 999-9999');
        });
    </script>
@endsection
