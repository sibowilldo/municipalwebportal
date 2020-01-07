<template>
    <form @submit.prevent="onSubmit" class="m-form m-form--fit m-form--label-align-right m-form--state">
        <div class="m-alert m-alert--icon alert alert-danger m-alert--square" role="alert" v-if="this.serverErrors.message">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                <strong>Oh snap! </strong>{{ this.serverErrors ? this.serverErrors.message: 'Change a few things up and try submitting again.'}}
            </div>
            <div class="m-alert__close">
                <button type="button" class="close" data-close="alert" aria-label="Close">
                </button>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="form-group m-form__group row"
                 :class="{ 'has-danger' : this.$v.name.$error || this.serverErrors.errors.name.length}">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-9">
                <input type="text" class="form-control m-input m-input--square" name="name"  v-model.trim="name"
                       @input="setName($event.target.value)"
                       @focus="nameFieldFocus"
                       :class="{ 'animated shake' : this.$v.name.$error || this.serverErrors.errors.name.length }">
                <div class="form-control-feedback" v-if="!this.$v.name.required && this.isSubmitted">Name field is required</div>
                <div class="form-control-feedback" v-if="this.serverErrors.errors.name.length">{{this.serverErrors.errors.name[0]}}</div>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="guards" class="col-3 col-form-label">Select Guard</label>
            <div class="col-9">
                <select v-model="guard" ref="guards" name="guard" class="form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker" @change="onChange($event)">
                    <option v-for="guard in getGuards" :value="guard">{{ guard }}</option>
                </select>
            </div>
        </div>
    <div class="form-group m-form__group row"  :class="{ 'has-danger' : this.$v.permissions.$error }">
        <label for="permissions" class="col-3 col-form-label">Permissions</label>
        <div class="col-9">
            <div class="m-portlet m-portlet--bordered m-portlet--unair m--marginless">
                <div class="m-portlet__body m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-md-12 col-lg-12">
                            <div class="m-widget1">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <span class="m-widget1__desc" id="span_guard_name">{{ guard.toUpperCase() }} Guard Permissions</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item"   :class="{ 'animated shake' : this.$v.permissions.$error }">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col-4" v-for="permission in getPermissions" :key="permission.id">
                                            <label class="m-checkbox m-checkbox--primary" v-if="guard === permission.guard_name">
                                                <input v-model.trim="permissions" name='permissions[]' :value="permission.id" type="checkbox"> {{ permission.name}}
                                                <span></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Stats2-1 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-control-feedback" v-if="!this.$v.permissions.required && this.isSubmitted">Please select at least one permission</div>
        </div>
        </div>
    </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-success m-btn--pill m-btn--air">Add Role</button>
                        <button type="reset" class="btn btn-secondary m-btn--pill m-btn--air">Reset Form</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import { required, minLength } from 'vuelidate/lib/validators';
    export default {
        name: "roles-create",
        data(){
            return {
                name:'',
                guard:'',
                permissions:[],
                isSubmitted : false,
                serverErrors: {
                    message: null,
                    errors: {
                        name: []
                    }
                }
            }
        },
        validations:{
            name: { required, minLength: minLength(4) },
            permissions: { required }
        },
        computed:{
            ...mapGetters(['getRoles', 'getPermissions', 'getGuards', 'getErrors'])
        },
        methods: {
            ...mapActions(['FETCH_ROLES', 'FETCH_PERMISSIONS', 'ADD_ROLE']),
            setName(value) {
                this.name = value;
                this.$v.name.$touch();
            },
            nameFieldFocus(){
                this.serverErrors.errors.name = [];
            },
            onChange(event){
                this.guard = event.target.value;
                this.permissions = [];
            },
            onSubmit(event){
                let payload = {
                    name: this.name,
                    guard: this.guard,
                    permissions: this.permissions
                };
                this.isSubmitted=true;
                this.$v.$touch();
                if (!this.$v.permissions.$error){
                    this.ADD_ROLE(payload)
                        .then(()=>{

                            this.serverErrors = JSON.parse(JSON.stringify(this.getErrors));
                            if(!this.getErrors.message){
                                let redirectUrl = this.getRoles[this.getRoles.length - 1].links._index;
                                window.location.replace(redirectUrl);
                            }
                        });
                }

            }

        },
        created() {
            this.FETCH_PERMISSIONS();
            this.FETCH_ROLES()
                .then(()=>{
                    this.guard = JSON.parse(JSON.stringify(this.getGuards[0]));
                });
        }
    }
</script>

<style scoped>

</style>
