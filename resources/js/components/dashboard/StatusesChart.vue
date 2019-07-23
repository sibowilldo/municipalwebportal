<template>
    <div class="small" style="position: relative;">
        <pie-chart :chart-data="chartData" :options="chartOptions"/>
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
                chartData: {
                    labels: ['In Progress', 'Completed', 'Cancelled', 'Escalated', 'Assigned', 'Other'],
                    datasets: [{
                        label: '# of Types',
                        data: [40, 19, 38, 15, 22, 18],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [ '#fff'
                        ],
                        borderWidth: 1
                    }]
                },
                chartOptions : {
                    maintainAspectRatio: true,
                    aspectRatio: 3,
                    legend:{
                        position: 'bottom',
                        labels :{
                            boxWidth: 10
                        }
                    }
                }
            }
        },
        mounted () {
            // Echo.private(`incident.${id}`)
            Echo.private(`incident.50`)
                .listen('IncidentStatusUpdated', (e) => {
                    console.log(e);
                });
            console.log('Component Mounted')

        },
        methods: {

            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
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