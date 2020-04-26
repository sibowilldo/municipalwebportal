@extends('layouts.master')

@section('title', 'Types')
@section('breadcrumbs', Breadcrumbs::render('types.create'))

@section('content')

	<div class="row">
		<div class="col-xl-8 offset-xl-2">
			<div class="m-portlet m-portlet--mobile  m-portlet--rounded">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ __('Types Details') }}
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
															<a href="{{ route('types.index') }}" class="m-nav__link">
																{{--<i class="m-nav__link-icon la la-users"></i>--}}
																<span class="m-nav__link-text">All Types</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="{{ route('categories.index') }}" class="m-nav__link">
																{{--<i class="m-nav__link-icon flaticon-users-1"></i>--}}
																<span class="m-nav__link-text">All Categories</span>
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
				{!! Form::open(['route'=> 'types.store', 'method'=>'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--state']) !!}
				@include('backend.types._form')
                @include('layouts.portlets.footer._footer', ['type'=> 'create', 'name' => 'Type'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('js')
	{{ Html::script('js/project-mdatatable.js') }}
	<script>
		const TableMethods = function(){
			return{
				init:function(datatable){

				}
			}
		}();
		const columns = [
			{
				field: 'id',
				title: '#',
				type: 'number',
				width: 25
			},
			{
				field: 'Actions',
				title: 'Actions',
				width: 150
			}
		];
		jQuery(document).ready(function() {

			TableElement.init($('#engineers'), columns);
		});

	</script>
@endsection
