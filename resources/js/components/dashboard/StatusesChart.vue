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
        <pie-chart :chart-data="statuses" :options="chartOptions"  v-if="dataFilled"/>
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
                statuses:{},
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
                    this.fillData()
                });
            Echo.channel('newIncidentChannel')
                .listen('.newIncidentEvent', (e) => {
                    this.fillData()
                });
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

                    this.statuses = {
                        labels: labelsData,
                        datasets: [
                            {
                                backgroundColor: colors,
                                data: datasetsData,
                                borderWidth: 1
                            }
                        ]
                    }
                    this.dataFilled = !!this.statuses.datasets[0].data.length;
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
