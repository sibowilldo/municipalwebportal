<template>
    <input :type="inputType" class="cssClass" :class="cssClass" >
</template>

<script>
    export default {
        name: "TextInput",
        props:  {
            inputType: {
                type:String,
                default: "text",
            },
            cssClass: {
                type: String,
                default: "form-control m-input"
            }
        },
        computed:{
            typeOf(){
                return this.type
            }
        }
    }
</script>

<style scoped>

</style>
