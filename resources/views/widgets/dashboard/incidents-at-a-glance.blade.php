
<!--Begin::Section-->
<div class="m-portlet">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-xl-4">

                <!--begin:: Widgets/Daily Reports-->
                <div class="m-widget14">
                    <div class="m-widget14__header m--margin-bottom-30">
                        <h3 class="m-widget14__title">
                            Daily Reported Incidents
                        </h3>
                        <span class="m-widget14__desc">

												</span>
                    </div>
                    <div class="m-widget14__chart" style="height:260px;">
                        <canvas id="m_chart_daily_sales"></canvas>
                    </div>
                </div>

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
                            <types-chart></types-chart>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Status Breakdown-->
            </div>
        </div>
    </div>
</div>

