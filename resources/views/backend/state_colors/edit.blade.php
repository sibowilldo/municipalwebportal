@extends('layouts.master')

@section('title', 'State Color')
@section('breadcrumbs', Breadcrumbs::render('state-colors.edit', $state_color))

@section('content')

	<div class="row">
		<div class="col-xl-6 offset-xl-3">
			<div class="m-portlet m-portlet--mobile">
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
															<a href="{{ route('state-colors.show', $state_color) }}" class="m-nav__link">
																{{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
																<span class="m-nav__link-text">View {{ $state_color->name }} details</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="{{ route('state-colors.index') }}" class="m-nav__link">
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

				{!! Form::model($state_color, ['route'=> ['state-colors.update', $state_color->id], 'method'=>'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right']) !!}
				@include('backend.state_colors._form')
                @include('layouts.portlets.footer._footer', ['type'=> 'edit', 'name' => 'Color'])

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
