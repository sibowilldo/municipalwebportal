
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
                    <div class="m-widget12 m-widget12--chart-bottom m--margin-top-10" style="min-height: 300px">
                        <div class="m-widget12__item">
                            <span class="m-widget12__text1">Logged<br><span>520</span></span>
                            <span class="m-widget12__text2">Completed<br><span>340</span></span>
                        </div>
                        <div class="m-widget12__chart m-portlet-fit--sides" style="height:290px;">
                            <canvas id="m_chart_finance_summary"></canvas>
                        </div>
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
                            <statuses-chart></statuses-chart>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Status Breakdown-->
            </div>
        </div>
    </div>
</div>