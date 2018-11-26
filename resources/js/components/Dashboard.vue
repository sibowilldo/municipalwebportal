<template>
        <div class="row">
            <div class="col-xl-8">
                <incidents-list></incidents-list>
            </div>
        </div>
</template>

<script>
    import IncidentsList from './widgets/_incidents-list'

    export default {
        components: {IncidentsList},
        name: 'Dashboard',
        mounted() {
            console.log('Dashboard mounted.')
        }
    }
</script>
