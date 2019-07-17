@extends('layouts.master')

@section('title', 'State Color')
@section('breadcrumbs', Breadcrumbs::render('state_colors.edit', $state_color))

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
															<a href="{{ route('state_colors.show', $state_color) }}" class="m-nav__link">
																{{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
																<span class="m-nav__link-text">View {{ $state_color->name }} details</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="{{ route('state_colors.index') }}" class="m-nav__link">
																{{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
																<span class="m-nav__link-text">All State Colors</span>
															</a>
														</li>
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

				{!! Form::model($state_color, ['route'=> ['state_colors.update', $state_color->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right']) !!}
				@include('backend.state_colors._form')

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