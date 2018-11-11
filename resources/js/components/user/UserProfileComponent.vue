<template>
    <div>
        {{ this.user }}
    </div>
</template>

<script>
    export default {
        name: "UserProfile",
        data() {
            return {
                user: {
                    firstname: 'Sibongiseni',
                    lastname: 'Msomi'
                }
            }
        },
        mounted() {
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.get('/api/auth/user')
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                })
        }
    }
</script>

<style scoped>

</style>