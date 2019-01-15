<template>
    <div class="row">
        <div class="col-xl-8">
            <user-list></user-list>
        </div>
    </div>
</template>

<script>
    import UserList from './widgets/Dashboard/_incidents-list'

    export default {
        components: {UserList},
        name: 'Users'
    }
</script>
