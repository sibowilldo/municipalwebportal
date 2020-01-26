<template>
    <form @submit.prevent="onSubmit" class="m-form m-form--fit m-form--label-align-right m-form--state">
        <transition name="fade">
            <div class="m-alert m-alert--icon alert alert-danger m-alert--square" role="alert"
                 v-if="this.hasServerErrors">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    <strong>Oh snap! </strong>
                    {{ this.serverErrors ? this.serverErrors.message: 'Change a few things up and try submitting again.'}}
                </div>
                <div class="m-alert__close">
                    <button aria-label="Close" class="close" data-close="alert" type="button">
                    </button>
                </div>
            </div>
        </transition>
        <div class="m-portlet__body">
            <div :class="{ 'has-danger' : this.$v.name.$error || this.serverErrors.errors.name.length}"
                 class="form-group m-form__group row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <div class="col-9">
                    <input :class="{ 'animated shake' : this.$v.name.$error || this.serverErrors.errors.name.length }" @focus="nameFieldFocus" @input="setName($event.target.value)" class="form-control m-input m-input--square"
                           name="name"
                           type="text"
                           v-model.trim="name">
                    <div class="form-control-feedback" v-if="!this.$v.name.required && this.isSubmitted">Name field is
                        required
                    </div>
                    <div class="form-control-feedback" v-if="this.serverErrors.errors.name.length">
                        {{this.serverErrors.errors.name[0]}}
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-3 col-form-label" for="guards">Select Guard</label>
                <div class="col-9">
                    <select @change="onChange($event)" class="form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker" name="guard"
                            ref="guards"
                            v-model="guard">
                        <option :value="guard" v-for="guard in guards">{{ guard }}</option>
                    </select>
                </div>
            </div>
            <div :class="{ 'has-danger' : this.$v.permissions.$error }" class="form-group m-form__group row">
                <label class="col-3 col-form-label" for="permissions">Permissions</label>
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
                                        <div :class="{ 'animated shake' : this.$v.permissions.$error }"
                                             class="m-widget1__item">
                                            <div class="row m-row--no-padding align-items-center">
                                                <div :key="permission.id" class="col-4"
                                                     v-for="permission in getPermissions">
                                                    <label class="m-checkbox m-checkbox--primary"
                                                           v-if="guard === permission.guard_name">
                                                        <input :value="permission.id" name='permissions[]'
                                                               type="checkbox" v-model.trim="permissions"> {{
                                                        permission.name}}
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
                    <div class="form-control-feedback" v-if="!this.$v.permissions.required && this.isSubmitted">Please
                        select at least one permission
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-md-10 offset-md-2">
                        <button class="btn btn-success m-btn--pill m-btn--air" type="submit">Add Role</button>
                        <button class="btn btn-secondary m-btn--pill m-btn--air" type="reset">Reset Form</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import {minLength, required} from 'vuelidate/lib/validators';

    export default {
        name: "roles-create",
        data() {
            return {
                name: '',
                guard: '',
                guards: [],
                permissions: [],
                isSubmitted: false,
                hasServerErrors: false,
                serverErrors: {
                    message: null,
                    errors: {
                        name: []
                    }
                }
            }
        },
        validations: {
            name: {required, minLength: minLength(4)},
            permissions: {required}
        },
        computed: {
            ...mapGetters(['getRoles', 'getPermissions', 'getGuards', 'getErrors'])
        },
        methods: {
            ...mapActions(['FETCH_ROLES', 'FETCH_PERMISSIONS', 'ADD_ROLE']),
            setName(value) {
                this.name = value;
                this.$v.name.$touch();
            },
            nameFieldFocus() {
                this.serverErrors.errors.name = [];
            },
            onChange(event) {
                this.guard = event.target.value;
                this.permissions = [];
            },
            async onSubmit(event) {
                let payload = {
                    name: this.name,
                    guard: this.guard,
                    permissions: this.permissions
                };

                try{
                    this.isSubmitted = true;
                    this.$v.$touch();
                    if (!this.$v.permissions.$error) {
                        await this.$store.dispatch('ADD_ROLE', payload)
                            .then(() => {
                                this.serverErrors = JSON.parse(JSON.stringify(this.getErrors));
                                if (this.getErrors.message) {
                                    this.hasServerErrors = true;
                                    setTimeout(() => {
                                        this.hasServerErrors = false;
                                    }, 3500);
                                    return;
                                }
                                let redirectUrl = this.getRoles[this.getRoles.length - 1].links._index;
                                // window.location.replace(redirectUrl);
                            });
                    }
                }catch (e) {

                }
            }

        },
        mounted() {
            this.FETCH_PERMISSIONS();
            this.FETCH_ROLES()
                .then(() => {
                    this.guards = this.getGuards;
                    this.guard = this.guards[0];
                });
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
