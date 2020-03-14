// import { Pie } from 'vue-chartjs'
//
// export default {
//     extends: Pie,
//     props: {
//         chartdata: {
//             type: Object,
//             default: null
//         },
//         options: {
//             type: Object,
//             default: null
//         }
//     },
//     mounted () {
//         this.renderChart(this.chartdata, this.options)
//     }
// }

import { Pie, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
    extends: Pie,
    mixins: [reactiveProp],
    props: ['options'],
    mounted () {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, {
            maintainAspectRatio: true,
            aspectRatio: 3,
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 10,
                }
            },
            onClick: this.handle
        })
    },
    methods: {
        handle (point, event) {
            const item = event[0]
            this.$events.fire('chart-filter', item)
        }
    }
}
