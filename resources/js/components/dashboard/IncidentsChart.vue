<template>
    <div class="m-widget12 m-widget12--chart-bottom m--margin-top-10" style="min-height: 300px">
        <div class="m-widget12__chart m-portlet-fit--sides" style="position: absolute; margin: 0;">
            <line-chart :chart-data="datacollection" :options="options" style="height: 300px"></line-chart>
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
                datacollection: {},
                options: {
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
                            tension: 0,
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
            this.fillData()
        },
        methods: {
            fillData() {
                this.datacollection = {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    datasets: [
                        {
                            label: 'Total',
                            backgroundColor: 'rgb(0, 197, 220)',
                            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                        }
                    ]
                }
            },
            getRandomInt() {
                return Math.floor(Math.random() * (40 - 5 + 1)) + 5
            }
        }
    }
</script>

<style>
    .small {
        max-width: 600px;
        margin: 10px auto;
    }
</style>
