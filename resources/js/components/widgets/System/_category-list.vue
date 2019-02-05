<template>

    <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Categories
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                <i class="la la-ellipsis-h m--font-brand"></i>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">Quick Actions</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">New Incident</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">Send Messages</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                        <span class="m-nav__link-text">Upload File</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__section">
                                                    <span class="m-nav__section-text">Useful Links</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                        <span class="m-nav__link-text">FAQ</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">Support</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit m--hide">
                                                </li>
                                                <li class="m-nav__item m--hide">
                                                    <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <div id="m_datatable" class="m_datatable">
                <el-row style="margin-bottom: 10px">
                    <el-col :span="4">
                        <el-button @click="clearFilter" icon="flaticon-interface-6" round>
                            Clear Filters
                        </el-button>
                    </el-col>
                    <el-col :span="6" :offset="14">
                        <el-input v-model="filters[0].value" placeholder="Search Filter...">
                        </el-input>
                    </el-col>
                </el-row>
                <data-tables v-loading="loading" ref="incidentsTable" :data="this.incidents.incidents"  :table-props="tableProps" :filters="filters" :pageSize="5" :pagination-props="{ pageSizes: [5, 10, 15, 20] }"  sortable="custom">
                    <el-table-column type="expand">
                        <template slot-scope="props">
                            <el-table-column type="expand">
                                <template slot-scope="props">
                                    <p><strong>Description: </strong>{{ props.row.description }}</p>
                                </template>
                            </el-table-column>
                        </template>
                    </el-table-column>
                    <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.prop">
                    </el-table-column>
                    <el-table-column
                            prop="status.name"
                            label="Status"
                            sortable
                            :filters="statuses"
                            :filter-method="filterHandler">
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="Operations"
                            width="200">
                        <template slot-scope="scope">
                            <el-popover
                                    placement="right"
                                    trigger="hover">
                                <el-row>
                                    <el-col :span="24">
                                        <div>
                                            <el-button type="text" @click="handleEditIncident(scope.row.id, $event)"><i class="m-nav__link-icon la la-edit"></i> Edit Details</el-button>
                                        </div>
                                        <div v-show="scope.row.status.name !== 'Completed'">
                                            <el-button type="text" icon="m-nav__link-icon  flaticon-user-settings">Assign Engineer</el-button>
                                        </div>
                                        <div>
                                            <el-button type="text"><i class="m-nav__link-icon flaticon-lifebuoy"></i> Update Status</el-button>
                                        </div>
                                    </el-col>
                                </el-row>
                                <el-button slot="reference" icon="el-icon-more" round size="small"> More</el-button>
                            </el-popover>
                            <el-button type="primary" icon="el-icon-check" circle size="small" title="Complete"></el-button>
                        </template>
                    </el-table-column>
                </data-tables>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</template>


<script>
    import Vue from 'vue'
    import { mapState } from 'vuex'
    import { DataTables, DataTablesServer } from 'vue-data-tables'

    Vue.use(DataTables)
    Vue.use(DataTablesServer)

    // import DataTables and DataTablesServer together
    import VueDataTables from 'vue-data-tables'
    Vue.use(VueDataTables)


    export default {
        name: "incidents-list",
        data() {
            return{
                statuses: [
                    {
                        text:'',
                        value:''
                    }
                ],
                loading: false,
                titles: [
                    {
                        prop: 'id',
                        label: 'ID'
                    },
                    {
                        prop: 'name',
                        label: 'Name'
                    },
                    {
                        prop: 'created',
                        label: 'Created'
                    },
                    {
                        prop: 'description',
                        label: 'Description'
                    },
                    {
                        prop: 'type.name',
                        label: 'Type'
                    }
                ],
                filters:[
                    {
                        value: '',
                        prop: ['id', 'name', 'status']
                    }
                ],
                tableProps: {
                    border: false,
                    stripe: true,
                    defaultSort: {
                        prop: 'id',
                        order: 'ascending'
                    }
                }
            }
        },
        created() {
            let vm = this;
            this.$store.dispatch('all_incidents')

            axios
                .get('api/auth/statuses/')
                .then(function(response){
                    vm.statuses = response.data.data.map(vm.mapFilters)
                })
                .catch((error)=>console.log('Error', error))
        },
        computed: {
            ...mapState(['incidents'])
        },
        methods:{
            handleEditIncident: function(id, event){
                this.$notify({
                    title: 'Success',
                    message: 'Selected Record ID: ' + id,
                    type: 'success'
                });
            },
            filterHandler(value, row, column) {
                return row.status.name === value;
            },
            clearFilter() {
                this.$refs.incidentsTable.$refs.elTable.clearFilter();
            },
            mapFilters(item, index){
                let text_value = {text: item.name, value: item.name}
                return text_value
            }
        },
        mounted(){}
    };
</script>

<style scoped>

</style>