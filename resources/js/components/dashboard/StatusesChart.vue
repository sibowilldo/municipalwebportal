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
            // Echo.private(`incident.${id}`)
            // Echo.private(`incident.50`)
            //     .listen('IncidentStatusUpdated', (e) => {
            //         console.log(e);
            //     });
            this.fillData();

        },
        methods: {
            fillData () {
                Vue.axios.get('charts/statuses').then((response) => {
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
</style>
