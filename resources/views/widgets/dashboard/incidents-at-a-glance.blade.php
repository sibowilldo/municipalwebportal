<!--Begin::Section-->
<div class="m-portlet m-portlet--head-sm" m-portlet="true" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon">
                    <i class="flaticon-pie-chart"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Overview Charts
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body  m-portlet__body--no-padding" style="padding: 0 !important;">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-xl-4">
                <div class="m-widget14">
                    <div class="m-widget14__header"><h3 class="m-widget14__title">
                          {{ __('Daily Reported Incidents') }}
                        </h3> <span class="m-widget14__desc">
                        {{ \Carbon\Carbon::now()->startOfWeek()->format('d M Y') }} - {{ \Carbon\Carbon::now()->format('d M Y') }}
                        </span></div>
                </div>
                <!--begin:: Widgets/Daily Reports-->
                <incidents-chart></incidents-chart>
                <!--end:: Widgets/Daily Reports-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Status Breakdown-->
                <div class="m-widget14">
                    <div class="m-widget14__header">
                        <h3 class="m-widget14__title">
                            Incident Types
                        </h3>
                        <span class="m-widget14__desc">
                        {{ Carbon\Carbon::now()->format('d M Y') }} Stats
                        </span>
                    </div>
                    <div class="row  align-items-center">
                        <div class="col">
                            <types-chart></types-chart>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Status Breakdown-->
            </div>
            <div class="col-xl-4">

                <!--begin:: Widgets/Status Breakdown-->
                <div class="m-widget14">
                    <div class="m-widget14__header">
                        <h3 class="m-widget14__title">
                            Incident Statuses
                        </h3>
                        <span class="m-widget14__desc">
                        {{ Carbon\Carbon::now()->format('d M Y') }} Stats
                        </span>
                    </div>
                    <div class="row  align-items-center">
                        <div class="col">
                            <statuses-chart></statuses-chart>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Status Breakdown-->
            </div>
        </div>
    </div>
</div>
