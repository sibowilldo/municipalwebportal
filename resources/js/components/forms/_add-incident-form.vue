<template>
    <div>
        <el-form :model="formData" :rules="rules" ref="formData" class="" label-position="right" label-width="200px" v-loading="loading">
            <el-form-item label="Incident Category" prop="category">
                 <el-select v-model="formData.category" placeholder="Choose Category..." @change="onChange" ref="elCategory">
                    <el-option  v-for="category in categories.categories" :key="category.id" :label="category.name" :value="category.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Incident Type" prop="type">
                <el-select v-model="formData.type" placeholder="Choose Type..." ref="elTypes">
                    <el-option  v-for="type in types" :key="type.id" :label="type.name" :value="type.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Location Address" prop="location_description">
                <el-input type="text" v-model="formData.location_description"></el-input>
            </el-form-item>
            <el-form-item label="Description" prop="description">
                <el-input type="textarea" v-model="formData.description"></el-input>
            </el-form-item>
            <el-form-item label="Make this Incident Public" prop="make_public">
                <el-radio-group v-model="formData.make_public" size="small">
                    <el-radio-button label="true">Yes</el-radio-button>
                    <el-radio-button label="false">No</el-radio-button>
                </el-radio-group>
            </el-form-item>
            <el-form-item>
                <slot name="form_actions">
                    <el-row>
                        <el-col :span="16" :offset="12">
                            <span class="dialog-footer">
                                <el-button @click="resetForm('formData')" round>Reset</el-button>
                                <el-button type="danger" @click="closeDialog" round>Cancel</el-button>
                                <el-button type="primary" @click="submitForm('formData')" round>Confirm</el-button>
                            </span>
                        </el-col>
                    </el-row>
                </slot>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    import Vue from 'vue'
    import vSelect from 'vue-select'
    Vue.component('v-select', vSelect)

    import { mapState } from 'vuex'
    import categories from "../../store/modules/categories";

    export default {
        data() {
            return {
                loading: false,
                types:null,
                formData: {
                    category: '',
                    type: '',
                    description: '',
                    location_description: '',
                    latitude: '',
                    longitude: '',
                    status: '',
                    make_public: true,
                },
                rules: {
                    category: [
                        { required: true, message: 'Please select Category', trigger: 'change' }
                    ],
                    type: [
                        { required: true, message: 'Please select Type', trigger: 'change' }
                    ],
                    location_description: [
                        { required: true, message: 'Please input Location', trigger: 'blur' }
                    ],
                    description: [
                        { required: true, message: 'Please input Description', trigger: 'blur' }
                    ]
                }
            };
        },
        created() {
            this.$store.dispatch('fetchCategories')
        },
        mounted(){

        },
        computed: {
            ...mapState(['categories'])

        },
        methods: {
            submitForm(formName) {
                const vm = this
                vm.$refs[formName].validate((valid) => {

                    if (valid) {
                        this.$notify({
                            title: 'Success',
                            message: 'Incident Logged... ',
                            type: 'success'
                        });
                        console.log('Form Data ', vm.formData)
                        // this.resetForm(formName) ToDo: call in axios promise
                        this.closeDialog()
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            closeDialog(){
                this.$emit('close')
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            getCategoryTypes(id){
                const categories = this.categories.categories
                const vm = this
                categories.forEach(function(value, index) {
                    if(value.id === id){
                        vm.formData.type = ""
                        vm.types = value.types
                        vm.loading = false
                    }
                })
            },
            onChange(category){
                this.loading = true
                this.getCategoryTypes(category)
            }
        },
        watch:{
            types: function(){

            }
        }
    }
</script>

<style>
    .v-select .dropdown-toggle:after{
        display: none !important;
    }
    .v-select .open-indicator:before {
        border-width: 2px 2px 0 0;
    }
    .v-select .dropdown-toggle .clear {
        font-weight: 300;
        margin-right: 15px;
        margin-top: 5px;
    }
</style>