<template>

    <div class="m-portlet m-portlet--full-height m-portlet--fit " m-portlet="true">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-calendar-2"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                       Daily Reported Incidents<small>
                    </small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="chart-no-data" role="alert" v-if="!dataFilled">
                <div class="chart-no-data_content">
                    <div class="chart-no-data__icon">
                        <i class="flaticon-graphic"></i>
                    </div>
                    <div class="chart-no-data__text">
                        <h3>No data to display!</h3>
                        <p>Once the data is available it will be displayed here.</p>
                    </div>
                </div>
            </div>
            <div class="tab-content" v-else>
                <div class="tab-pane active">
                    <div class="m-widget12 m-widget12--chart-bottom m--margin-top-10" style="min-height: 430px">
                        <div class="m-widget12__chart m-portlet-fit--sides" style="height:290px;">
                            <line-chart :chart-data="chartData" :options="chartOptions" style="height: 290px"></line-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import LineChart from '../../charts.js-lib/LineChart'

    export default {
        components: {
            LineChart
        },
        data() {
            return {
                echo: null,
                dataFilled: false,
                chartData:{},
                chartOptions: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        mode: 'nearest',
                        intersect: false,
                        position: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 2,
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: false,
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    elements: {
                        line: {
                            tension: 0.4,
                            borderWidth: 0
                        },
                        point: {
                            pointStyle: 'circle',
                            radius: 0,
                            borderWidth: 0
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 10,
                            bottom: 0
                        }
                    }
                }
            }
        },
        mounted() {
            Echo.channel('newIncidentChannel')
                .listen('.newIncidentEvent', (e) => {
                    this.fillData()
                });
            this.fillData()
        },
        methods: {
            fillData() {
                Vue.axios.get('charts/incidents').then((response) => {
                    let labelsData = [],
                        datasetsData = [],
                        colors = [];
                    let data = response.data.data, start = response.data.start, end = response.data.end;
                    data.forEach(function(i,v){
                        i.data > 0 ? labelsData.push(i.label):'';
                        i.data > 0 ? datasetsData.push(i.data):'';
                        i.data > 0 ? colors.push(i.color):'';
                    });

                    this.chartData = {
                        labels: labelsData,
                        datasets: [
                            {
                                backgroundColor: 'rgb(0, 197, 220)',
                                data: datasetsData,
                                borderWidth: 1
                            }
                        ]
                    }
                    this.dataFilled = !!this.chartData.datasets[0].data.length;
                });
            }
        }
    }
</script>

<style scoped>
    .small {
        max-width: 600px;
        margin: 10px auto;
    }
    .chart-no-data {
        display: flex;
        align-items: center;
        justify-content: center;
        height: calc(100% - 2.2rem - 2.2rem)
    }
    .chart-no-data__icon{
        text-align: center;
    }
    .chart-no-data__icon i{
        font-size: 12rem;
        color: rgba(0,0,0,.1);
        margin: 0 auto
    }
    .chart-no-data__text h3{
        text-align: center;
        font-size: 1.5rem;
        text-transform: uppercase;
        font-weight: 800;
        color: #d50000;
    }
    .chart-no-data__text p{
        text-align: center;
    }
</style>
