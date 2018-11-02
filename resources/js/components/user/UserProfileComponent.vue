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
        }
    }
</script>

<style scoped>

</style>