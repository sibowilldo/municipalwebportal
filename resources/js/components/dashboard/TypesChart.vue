<template>
    <div class="small" style="position: relative;">
        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline m-alert--air alert alert-danger alert-dismissible fade show" role="alert" v-if="!dataFilled">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation-1"></i>
            </div>
            <div class="m-alert__text">
                <strong>No data to display!</strong><br> Once the data is available it will be displayed here.
            </div>
        </div>
        <pie-chart :chart-data="chartData" :options="chartOptions"  v-if="dataFilled"/>
    </div>
</template>

<script>
    import PieChart from '../../charts.js-lib/PieChart'
    import * as math from "lodash";

    export default {
        components: {
            PieChart
        },
        data () {
            return {
                dataFilled: false,
                chartData:{},
                chartOptions : {
                    maintainAspectRatio: true,
                    aspectRatio: 3,
                    legend:{
                        position: 'bottom',
                        labels :{
                            boxWidth: 10,
                        }
                    }
                }
            }
        },
        mounted () {
            Echo.channel('incidentUpdatedChannel')
                .listen('.incidentUpdatedEvent', (e) => {
                    console.log('Whats here', e)
                    this.fillData();
                    this.$notify(`<span data-notify="title">Update Notifications</span> <span data-notify="message">${ e.message } </span>`, 'info');
                });
            Echo.channel('newIncidentChannel')
                .listen('.newIncidentEvent', (e) => {
                    this.fillData();
                    this.$notify(`<span data-notify="title">Notification Title</span> <span data-notify="message">New Incident has been logged</span>`, 'success');
                });
            this.fillData();

        },
        methods: {
            fillData () {
                Vue.axios.get('charts/types').then((response) => {
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
                                backgroundColor: colors,
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

<style>
    .small {
        max-width: 600px;
        margin:  10px auto;
    }


    .alert {
        min-width: 300px; }
    .alert .close {
        right: 10px !important; }
    @media (min-width: 769px) and (max-width: 1024px) {
        .alert {
            max-width: 70%; } }
    @media (max-width: 768px) {
        .alert {
            max-width: 90%; } }
    .alert[data-notify-position=top-center], .alert[data-notify-position=bottom-center] {
        width: 30%; }
    @media (min-width: 769px) and (max-width: 1024px) {
        .alert[data-notify-position=top-center], .alert[data-notify-position=bottom-center] {
            width: 70%; } }
    @media (max-width: 768px) {
        .alert[data-notify-position=top-center], .alert[data-notify-position=bottom-center] {
            width: 90%; } }
    .alert .close {
        padding: 0.25rem 0 0 2rem;
        font-size: 1rem; }
    .alert .icon {
        position: absolute; }
    .alert [class^="la-"],
    .alert [class*=" la-"] {
        font-size: 1.8rem; }
    .alert [class^="fa-"],
    .alert [class*=" fa-"] {
        font-size: 1.6rem; }
    .alert [class^="flaticon-"],
    .alert [class*=" flaticon-"] {
        font-size: 1.8rem; }
    .alert [class^="la-"],
    .alert [class*=" la-"] {
        margin-top: -0.1rem; }
    .alert [class^="fa-"],
    .alert [class*=" fa-"] {
        margin-top: -0.1rem; }
    .alert [class^="flaticon-"],
    .alert [class*=" flaticon-"] {
        margin-top: -0.4rem; }
    .alert [data-notify=title] {
        display: block;
        font-weight: 500; }
    .alert [data-notify=title] {
        padding-left: 2.85rem; }
    .alert [data-notify=message] {
        display: inline-block;
        padding-left: 2.85rem; }
    .alert [data-notify=title]:not(:empty) ~ [data-notify=message] {
        margin-top: 0.2rem; }
    .alert .progress {
        margin-top: 0.5rem;
        line-height: 0.5rem; }
    .alert .progress .progress-bar {
        height: 0.5rem; }
</style>
