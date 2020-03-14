<template>
    <div class="m-portlet m-portlet--full-height m-portlet--fit ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-layers"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Incident Types<small>
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
            <pie-chart :chart-data="chartData" v-if="dataFilled" />
        </div>
    </div>
</template>

<script>
    import PieChart from '../../charts.js-lib/PieChart'

    export default {
        components: {
            PieChart
        },
        data() {
            return {
                dataFilled: false,
                chartData: {}
            }
        },
        mounted() {
            Echo.channel('incidentUpdatedChannel')
                .listen('.incidentUpdatedEvent', (e) => {
                    this.fillData();
                    this.$notify(`<span data-notify="title">Update Notifications</span> <span data-notify="message">${e.message} </span>`, 'info');
                });
            Echo.channel('newIncidentChannel')
                .listen('.newIncidentEvent', (e) => {
                    this.fillData();
                    this.$notify(`<span data-notify="title">Notification Title</span> <span data-notify="message">New Incident has been logged</span>`, 'success');
                });
            this.fillData();

        },
        methods: {
            fillData() {
                Vue.axios.get('charts/types').then((response) => {
                    let labelsData = [],
                        datasetsData = [],
                        colors = [],
                        ids = [];
                    let data = response.data.data, start = response.data.start, end = response.data.end;
                    data.forEach(function (i, v) {
                        i.data > 0 ? labelsData.push(i.label) : '';
                        i.data > 0 ? datasetsData.push(i.data) : '';
                        i.data > 0 ? colors.push(i.color) : '';
                        i.data > 0 ? ids.push(i.id):'';
                    });

                    this.chartData = {
                        labels: labelsData,
                        datasets: [
                            {
                                backgroundColor: colors,
                                data: datasetsData,
                                borderWidth: 1,
                                ids: ids,
                                queryMeta: {
                                    type: 'types',
                                    startDate: start,
                                    endDate: end
                                }
                            }
                        ]
                    };
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
