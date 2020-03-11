<template>
    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
        <div class="row align-items-center">
            <div class="col-xl-10">
                <div class="form-group m-form__group row align-items-center">
                    <div class="col-md-3">
                        <div class="m-form__group m-form__group--inline">
                            <div class="m-form__label">
                                <label for="m_form_status">Status</label>
                            </div>
                            <div class="m-form__control">
                                <multiselect :close-on-select="true" :options="this.statuses" :searchable="true"
                                             :show-labels="true" :value="this.status" @remove="doRemoveStatusFilter"
                                             @select="doStatusFilter" selectLabel="Click to Filter"
                                             deselectLabel="Click to Reset" label="name" placeholder="Select a status..."
                                             track-by="id" v-model="status"></multiselect>
                            </div>
                        </div>
                        <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="m-form__group m-form__group--inline">
                            <div class="m-form__label">
                                <label class="m-label m-label--single" for="m_form_type">Category</label>
                            </div>
                            <div class="m-form__control">
                                <multiselect :close-on-select="true" :options="this.categories" :searchable="true"
                                             :show-labels="true" :value="this.category" @remove="doRemoveCategoryFilter"
                                             @select="doCategoryFilter" selectLabel="Click to Filter"
                                             deselectLabel="Click to Reset" label="name" placeholder="Select a category..."
                                             track-by="id" v-model="category"></multiselect>
                            </div>
                        </div>
                        <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="m-form__group m-form__group--inline">
                            <div class="m-form__label">
                                <label class="m-label m-label--single text-nowrap" for="m_form_type">Search for</label>
                            </div>
                            <div class="m-form__control">
                                <div class="input-group input-group">
                                    <div class="input-group-prepend input-group-btn">
                                        <button @click="resetFilter"
                                                class="btn btn-danger m-btn"
                                                title="Clear Filter" v-b-tooltip.hover>
                                            <i class="la la-refresh"></i>
                                        </button>
                                    </div>
                                    <input @keyup.enter="doFilter" class="form-control" placeholder="Reference or Summary"
                                           type="text"
                                           v-model="filterText">
                                    <div class="input-group-append input-group-btn">

                                        <b-button
                                            @click="doFilter"
                                            class="m-btn"
                                            title="Search" v-b-tooltip.hover
                                            variant="dark">
                                            <span>
                                            <i class="la la-search"></i>
                                            </span>
                                        </b-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {Multiselect} from "vue-multiselect";
    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: "filterbar",
        components: {
            Multiselect
        },
        mounted() {
            this.FETCH_STATUSES();
            this.FETCH_CATEGORIES();
        },
        data() {
            return {
                filterText: '',
                status: null,
                category: null
            }
        },
        computed: {
            ...mapGetters(
                {
                    statuses: 'getStatuses',
                    categories: 'getCategories',
                }
            )
        },
        methods: {
            ...mapActions(['FETCH_STATUSES', 'FETCH_CATEGORIES']),
            doFilter(selected, id) {
                this.$events.fire('search-filter', this.filterText)
            },
            doStatusFilter(selected, id) {
                this.$events.fire('status-filter', selected)
            },
            doCategoryFilter(selected, id) {
                this.$events.fire('category-filter', selected)
            },
            doRemoveStatusFilter() {
                this.$events.fire('remove-status-filter')
            },
            doRemoveCategoryFilter(selected, id) {
                this.$events.fire('remove-category-filter')
            },
            resetFilter() {
                this.filterText = '';
                this.$events.fire('filter-reset')
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .multiselect__tags {
        padding: 10px 10px 0 8px;
        border-radius: 3px;
        border: 1px solid #e8e8e8;
        min-height: 45px;
    }

    .multiselect, .multiselect__single {
        font-size: .95em !important
    }

    .multiselect__content-wrapper {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .input-group > .form-control:not(:last-child), .input-group > .custom-select:not(:last-child) {
        min-height: 45px;
    }
</style>
