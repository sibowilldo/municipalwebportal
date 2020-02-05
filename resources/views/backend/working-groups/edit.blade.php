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
                                                        <a href="{{ route('working-groups.index') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-users"></i>
                                                            <span class="m-nav__link-text">All Working Groups</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('working-groups.show', $working_group->id) }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon la la-list-alt"></i>
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

				{!! Form::model($working_group, ['route'=> ['working-groups.update', $working_group->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right']) !!}
				@include('backend.working-groups._form')

				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-md-10 offset-md-2">
								<button type="submit" class="btn btn-success m-btn--pill m-btn--air pull-right m-btn--custom m-btn--icon">
                                    <span><i class="la la-check"></i><span>Update Details</span></span>

                                </button>
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
