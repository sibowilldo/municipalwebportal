<template>
        <div class="row">
            <template slot="page_title">
                <h3 class="m-subheader__title ">Dashboard</h3>
            </template>
            <div class="col-xl-8">
                <incidents-list></incidents-list>
            </div>
            <div class="col-xl-4">
                <incidents-summary></incidents-summary>
            </div>
        </div>
</template>

<script>
    import IncidentsList from './widgets/Dashboard/_incidents-list'
    import IncidentsSummary from './widgets/Dashboard/_incidents-summary'

    export default {
        components: {IncidentsSummary, IncidentsList},
        name: 'Dashboard'
    }
</script>
