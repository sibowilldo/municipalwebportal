<template>
    <div class="row">
        <div class="col-xl-12">
            <div  class="m-portlet m-portlet--head-sm" m-portlet="true" id="dashboard_incidents_table">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-exclamation"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Incidents
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item mr-3">
                                <b-button
                                    v-b-modal.report-incident
                                    variant="danger"
                                    class="m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                    <i class="la la-plus"></i>
                                    Log Incident
                                    </span>
                                </b-button>

                                <b-modal id="report-incident"
                                         title="Log Incident"
                                         size="lg"
                                        footer-bg-variant="light">
                                        <incident-form></incident-form>
                                    <template v-slot:modal-footer>
                                        <div class="w-100">
                                            <b-button
                                                variant="success"
                                                @click="onSubmitIncident"
                                                class="float-right m-btn--pill m-btn--air"
                                            >
                                                Save Incident
                                            </b-button>
                                            <b-button
                                                variant="light"
                                                @click="show=false"
                                                class="float-left m-btn--pill m-btn--air"
                                            >
                                                Cancel & Close
                                            </b-button>
                                        </div>
                                    </template>
                                </b-modal>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" m-portlet-tool="toggle" class="m-portlet__nav-link btn btn-sm btn-secondary m-btn m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-angle-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m_datatable">
                        <filter-bar></filter-bar>
                        <vuetable ref="vuetable"
                                  api-url="api/v1/incidents"
                                  :fields="columns"
                                  :css="css.table"
                                  :sort-order="sortOrder"
                                  :append-params="moreParams"
                                  pagination-path="meta"
                                  @vuetable:pagination-data="onPaginationData">
                        <template slot="actions" slot-scope="props">
                            <div class="custom-actions">
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                        v-b-tooltip.hover title="Assign Engineer"
                                        @click="onAction('assign-user', props.rowData, props.rowIndex)">
                                    <i class="la la-user"></i>
                                </button>
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                        v-b-tooltip.hover title="Assign Specialist"
                                        @click="onAction('assign-specialist', props.rowData, props.rowIndex)">
                                    <i class="la la-user-secret"></i>
                                </button>
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                        v-b-tooltip.hover title="Assign Group"
                                        @click="onAction('assign-team', props.rowData, props.rowIndex)">
                                    <i class="la la-users"></i>
                                </button>
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
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
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from '../../vuetable2-configs/VuetablePaginationBootstrap'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import FilterBar from '../../vuetable2-configs/filterbar'
    import IncidentForm from '../incidents/form'
    import vuetablecss from '../../vuetable2-configs/css'
    import vuetableColumns from '../../vuetable2-configs/columns'
    import moment from  'moment'

    export default {
        name: "dashboard",
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
            FilterBar,
            IncidentForm
        },
        mounted() {
            this.$events.$on('remove-status-filter', eventData => this.onRemoveStatusFilter(eventData));
            this.$events.$on('remove-category-filter', eventData => this.onRemoveCategoryFilter(eventData));
            this.$events.$on('status-filter', eventData => this.onStatusFilter(eventData));
            this.$events.$on('category-filter', eventData => this.onCategoryFilter(eventData));
            this.$events.$on('search-filter', eventData => this.onSearchFilter(eventData));
            this.$events.$on('filter-reset', e => this.onFilterReset())
        },
        data: () => {
            return {
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
                return  `<span class="m-badge m-badge--${ value.css_class } m-badge--wide shadow-sm"> ${ value.name } </span>`
            },
            categoryColumnFn: (value) => {
                return  `<span class="m-badge  m-badge--dot shadow m-badge--${value.state_color_id.toLowerCase()} m-badge--wide"></span>
                        &nbsp;<span class="m--font-bold">${value.name }</span>`
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            onAction (action, data, index) {
                switch(action){
                    case 'assign-user':
                        console.log('assign user', data.name)

                        break;
                    case 'assign-specialist':
                        console.log('assign specialist', data.name)

                        break;
                    case 'assign-team':
                        console.log('assign team/group', data.name)

                        break;
                    case 'view-item':
                        console.log('view details', data.name )

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
            onRemoveStatusFilter(data){
                this.moreParams.status = null;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onRemoveCategoryFilter(data){
                this.moreParams.category = null
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onSearchFilter(data){
                this.moreParams.search =  data;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            },
            onFilterReset(){
                this.moreParams.search =  null;
                Vue.nextTick( () => this.$refs.vuetable.refresh());
            }
        }
    }
</script>

<style>

</style>
