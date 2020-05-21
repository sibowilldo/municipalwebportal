<template>
    <div class="row">
        <div class="col-xl-12">
            <div  class="m-portlet m-portlet--head-sm" m-portlet="true" id="dashboard_incidents_table">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-warning-sign"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Incidents
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m_datatable vuetable-wrapper table-responsive table-responsive-md">
                        <loading :active.sync="isLoading"
                                 :is-full-page="false"/>
                        <filter-bar></filter-bar>
                        <vuetable ref="vuetable"
                                  api-url="api/v1/incidents"
                                  wrapper-class="vuetable-wrapper"
                                  :fields="columns"
                                  :css="css.table"
                                  :sort-order="sortOrder"
                                  :append-params="moreParams"
                                  pagination-path="meta"
                                  @vuetable:pagination-data="onPaginationData"
                                  @vuetable:loading="isLoading=true"
                                  @vuetable:loaded="isLoading=false">
                        <template slot="actions" slot-scope="props">
                            <div class="custom-actions">
                                <button class="m-portlet__nav-link m-btn--pill btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only "
                                        v-b-tooltip.hover title="Assign Engineer"
                                        @click="onAction('assign-user', props.rowData, props.rowIndex)">
                                    <i class="la la-user"></i>
                                </button>
                                <button class="m-portlet__nav-link m-btn--pill btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only "
                                        v-b-tooltip.hover title="Assign Specialist"
                                        @click="onAction('assign-specialist', props.rowData, props.rowIndex)">
                                    <i class="la la-user-secret"></i>
                                </button>
                                <button class="m-portlet__nav-link m-btn--pill btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only "
                                        v-b-tooltip.hover title="Assign Group"
                                        @click="onAction('assign-team', props.rowData, props.rowIndex)">
                                    <i class="la la-users"></i>
                                </button>
                                <button class="m-portlet__nav-link m-btn--pill btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only "
                                        v-b-tooltip.hover title="View Details"
                                        @click="onAction('view-item', props.rowData, props.rowIndex)">
                                    <i class="la la-eye"></i>
                                </button>
                            </div>
                        </template>
                        </vuetable>
                        <div class="row">
                            <div class="col">
                                <vuetable-pagination ref="pagination"
                                                     @vuetable-pagination:change-page="onChangePage">
                                </vuetable-pagination>
                            </div>
                            <div class="col text-right">
                                <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from '../../vuetable2-configs/VuetablePaginationBootstrap'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import FilterBar from '../../vuetable2-configs/filterbar'
    import vuetablecss from '../../vuetable2-configs/css'
    import vuetableColumns from '../../vuetable2-configs/columns'
    import moment from  'moment'

    export default {
        name: "dashboard",
        components: {
            Loading,
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
            FilterBar
        },
        mounted() {
            Echo.channel('incidentUpdatedChannel').listen('.incidentUpdatedEvent', (e) => {
                    Vue.nextTick( () => this.$refs.vuetable.refresh());
                });
            Echo.channel('newIncidentChannel').listen('.newIncidentEvent', (e) => {
                    Vue.nextTick( () => this.$refs.vuetable.refresh());
                });
            this.$events.$on('remove-status-filter', eventData => this.onRemoveStatusFilter(eventData));
            this.$events.$on('remove-category-filter', eventData => this.onRemoveCategoryFilter(eventData));
            this.$events.$on('status-filter', eventData => this.onStatusFilter(eventData));
            this.$events.$on('category-filter', eventData => this.onCategoryFilter(eventData));
            this.$events.$on('search-filter', eventData => this.onSearchFilter(eventData));
            this.$events.$on('filter-reset', e => this.onFilterReset());
            this.$events.$on('chart-filter', eventData => this.onChartFilter(eventData));
        },
        data: () => {
            return {
                isLoading: false,
                css: vuetablecss,
                columns: vuetableColumns.columns,
                sortOrder: [
                    {
                        field: 'created',
                        sortField: 'created_at',
                        direction: 'desc'
                    }
                ],
                moreParams: {}
            }
        },
        methods: {
            formatDate: (value, fmt = 'D MMM YYYY') => {
                return (value == null) ? '' : moment(value, 'YYYY-MM-DD H:mm:ss').format(fmt)
            },
            formatCoordinates: (value) => {
                return `${value.longitude}, ${value.latitude}`
            },
            statusColumnFn: (value) => {
                return  `<span class="m-badge m-badge--${ value.css_class } m-badge--rounded px-2 shadow-sm"> ${ value.name } </span>`
            },
            categoryColumnFn: (value) => {
                return  `<span class="m-badge  m-badge--dot shadow m-badge--${value.state_color}"></span>
                        &nbsp;<span class="m--font-boldest m--font-${value.state_color}">${value.name }</span>`
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            onCreateIncident(){
                window.location.assign('/incidents/create')
            },
            onAction (action, data, index) {
                switch(action){
                    case 'assign-user':
                        window.location.assign(`/incidents/${data.id}/engineers`)
                        break;
                    case 'assign-specialist':
                        window.location.assign(`/incidents/${data.id}/specialists`)

                        break;
                    case 'assign-team':
                        window.location.assign(`/incidents/${data.id}/groups`)
                        break;
                    case 'view-item':
                        window.location.assign(`/incidents/${data.id}`)

                        break;
                    default:
                        console.log('action not supported')
                }
            },
            onSubmitIncident(){
                this.$events.fire('submit-incident', this.form)
            },
            onStatusFilter(data){
                this.moreParams.status = data.id;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onCategoryFilter(data){
                this.moreParams.category = data.id;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onRemoveStatusFilter(){
                this.moreParams.status = null;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onRemoveCategoryFilter(){
                this.moreParams.category = null
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onSearchFilter(data){
                this.moreParams.search =  data;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onFilterReset(){
                let parameters = this.moreParams;
                Object.keys(this.moreParams).forEach(function (param) {
                    parameters[param] = null;
                });
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onChartFilter(data) {
                let chartType = data._chart.data.datasets[0].queryMeta.type;
                let selectedValue = data._chart.data.datasets[0].ids[data._index];
                switch (chartType){
                    case "types":{
                        this.moreParams.type = selectedValue;
                        break;
                    }
                    case "statuses":{
                        this.moreParams.status = selectedValue;
                        break;
                    }
                }
                this.moreParams.start_date =  data._chart.data.datasets[0].queryMeta.startDate;
                this.moreParams.end_date =  data._chart.data.datasets[0].queryMeta.endDate;
                this.moreParams.has_range =  true;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            }
        }
    }
</script>

<style>
    .table-striped tbody tr:hover{
        background-color:rgba(0, 0, 0, 0.1);
    }
    tr:hover td .custom-actions{
        width: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
    }
    .custom-actions {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        width: 50px;
        background: rgb(232,232,232) ;
        /*background: -moz-linear-gradient(95deg, rgba(255,255,255,0.0578606442577031) 0%, rgba(232,232,232,1) 30%);*/
        /*background: -webkit-linear-gradient(95deg, rgba(255,255,255,0.0578606442577031) 0%, rgba(232,232,232,1) 30%);*/
        /*background: linear-gradient(95deg, rgba(255,255,255,0.0578606442577031) 0%, rgba(232,232,232,1) 30%);*/
        /*filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#f4f4f4",GradientType=1);*/
        overflow: hidden;
        transition: cubic-bezier(0, 0, 0.2, 1) width 200ms;
    }
    td.vuetable-slot.text-center {position: relative;}
</style>
