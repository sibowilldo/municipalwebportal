<!--begin:: Widgets/Stats-->
<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::Total Profit-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            {{ __('Summary') }}
                        </h4><br>
                        <span class="m-widget24__desc">
													{{ __('All Incidents') }}
												</span>
                        <span class="m-widget24__stats m--font-brand">
													{{ count($incidents) }}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
													Change
												</span>
                        <span class="m-widget24__number">
													78%
												</span>
                    </div>
                </div>

                <!--end::Total Profit-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Feedbacks-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            {{ __('Assigned') }}
                        </h4><br>
                        <span class="m-widget24__desc">
                            {{ \Carbon\Carbon::today()->format('D, d M Y')}}
												</span>
                        <span class="m-widget24__stats m--font-success">
													{{ count($incidents->where('status_id', 1)) }}

												</span>

                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-success" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
													Change
												</span>
                        <span class="m-widget24__number">
													84%
												</span>
                    </div>
                </div>

                <!--end::New Feedbacks-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Orders-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            New Orders
                        </h4><br>
                        <span class="m-widget24__desc">
													Fresh Order Amount
												</span>
                        <span class="m-widget24__stats m--font-danger">
													567
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
													Change
												</span>
                        <span class="m-widget24__number">
													69%
												</span>
                    </div>
                </div>

                <!--end::New Orders-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Users-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            New Users
                        </h4><br>
                        <span class="m-widget24__desc">
													Joined New User
												</span>
                        <span class="m-widget24__stats m--font-success">
													276
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
													Change
												</span>
                        <span class="m-widget24__number">
													90%
												</span>
                    </div>
                </div>

                <!--end::New Users-->
            </div>
        </div>
    </div>
</div>
<!--end:: Widgets/Stats-->