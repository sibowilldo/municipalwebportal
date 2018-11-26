<template>
    <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Incidents
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
                                                        <span class="m-nav__link-text">Create Post</span>
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
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded m-datatable--scroll" id="m_datatable_latest_orders" style="">
                <table class="m-datatable__table" style="display: block; min-height: 300px; max-height: 380px;">
                    <thead class="m-datatable__head">
                        <tr class="m-datatable__row" style="left: 0px;">
                            <th data-field="RecordID" class="m-datatable__cell--center m-datatable__cell m-datatable__cell--check">
                                <span style="width: 40px;"><label class="m-checkbox m-checkbox--single m-checkbox--all m-checkbox--solid m-checkbox--brand"><input type="checkbox">&nbsp;<span></span></label></span></th>
                            <th data-field="OrderID" class="m-datatable__cell m-datatable__cell--sort" data-sort="asc"><span style="width: 50px;">ID<i class="la la-arrow-up"></i></span></th>
                            <th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 150px;">Reference</span></th>
                            <th data-field="ShipDate" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Name</span></th>
                            <th data-field="Type" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">Reported</span></th>
                            <th data-field="Status" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">Status</span></th>
                            <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="m-datatable__body ps ps--active-y" style="max-height: 329px;">
                        <tr data-row="0" class="m-datatable__row" style="left: 0px;"  v-for="incident in incidents.incidents">
                            <td class="m-datatable__cell--center m-datatable__cell m-datatable__cell--check" data-field="RecordID"><span style="width: 40px;"><label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand"><input type="checkbox" value="45">&nbsp;<span></span></label></span>
                            </td>
                            <td class="m-datatable__cell--sorted m-datatable__cell" data-field="OrderID"><span style="width: 50px;">{{ incident.id }}</span></td>
                            <td data-field="ShipName" class="m-datatable__cell"><span style="width: 150px;">{{ incident.reference }}</span></td>
                            <td data-field="ShipDate" class="m-datatable__cell"><span style="width: 110px;">{{ incident.name }}</span></td>
                            <td data-field="Type" class="m-datatable__cell"><span style="width: 100px;"><span class="m-badge m-badge--primary m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-primary">{{ incident.created_at | moment("DD MMM YYYY") }}</span></span></td>
                            <td data-field="Status" class="m-datatable__cell"><span style="width: 100px;"><span class="m-badge  m-badge--success m-badge--wide">Success</span></span></td>
                            <td data-field="Actions" class="m-datatable__cell"><span style="overflow: visible; position: relative; width: 110px;">
                                <div class="dropdown "><a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                    <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                    <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                                </div>
                            </div>
                                <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">
                                    <i class="la la-trash"></i>
                                </a>
                            </span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        name: "incidents-list",
        mounted() {
            this.$store.dispatch('allIncidents')
        },
        computed: {
            ...mapState({
                incidents: 'incidents'
            })
        },

    }
</script>

<style scoped>

</style>