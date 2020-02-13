<template>
    <form @submit.prevent="onSubmit" class="m-form m-form--fit m-form--label-align-right m-form--state">

        <loading :active.sync="isLoading"
                 :background-color='overlay.backgroundColor'
                 :can-cancel="true"
                 :color='overlay.color'
                 :is-full-page="true"
                 :loader="overlay.loader"/>

        <transition name="fade">
            <div class="m-alert m-alert--icon alert alert-danger m-alert--square" role="alert"
                 v-if="this.hasServerErrors">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    <strong>Oh snap! </strong>
                    {{
                    this.serverErrors ?
                    this.serverErrors.message:
                    'Change a few things up and try submitting again.'
                    }}
                </div>
                <div class="m-alert__close">
                    <button aria-label="Close" class="close" data-close="alert" type="button">
                    </button>
                </div>
            </div>
        </transition>
        <div class="m-portlet__body">
            <b-row>
                <b-col cols="10" offset-xl="1">
                    <b-form-group label="Name:" label-for="name" :state="validateInput('name')">
                        <b-form-input id="name" size="lg" type="text" v-model.trim="form.name"
                                      :state="validateInput('name')" @change="nameFieldFocus">
                        </b-form-input>
                        <b-form-invalid-feedback
                            id="name-live-feedback"
                        >
                            Name is a required field and must be min of 3 and max of 100 characters.
                        </b-form-invalid-feedback>

                        <span class="form-control-feedback text-danger" v-if="this.serverErrors.errors.name.length>0">{{ this.serverErrors.errors.name[0] }}</span>
                    </b-form-group>
                    <b-form-group label="Select Guard:" label-for="guard">
                        <multiselect :close-on-select="true" :options="this.guards" :searchable="true"
                                     :show-labels="true" placeholder="Select a Guard"
                                     v-model.trim="form.guard"/>
                    </b-form-group>
                    <b-form-group label="Permissions" label-for="permissions" :state="validateInput('permissions')">
                        <div class="m-portlet m-portlet--bordered m-portlet--unair m--marginless m-portlet--rounded">
                            <div class="m-portlet__body m-portlet__body--no-padding">
                                <div class="row m-row--no-padding m-row--col-separator-xl">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="m-widget1">
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <span class="m-widget1__desc text-uppercase" id="span_guard_name">{{ form.guard }} guard Permissions</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :class="{ 'animated shake' : validateInput('permissions') }"
                                                 class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div :key="permission.id" class="col-4"
                                                         v-for="permission in getPermissions">
                                                        <label class="m-checkbox m-checkbox--primary"
                                                               v-if="form.guard === permission.guard_name">
                                                            <input :value="permission.id" name='permissions[]'
                                                                   type="checkbox" v-model.trim="form.permissions">
                                                            <span></span>{{ permission.name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end:: Widgets/Stats2-1 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-control-feedback text-danger"
                             v-if="!this.$v.form.permissions.required && this.isSubmitted">Please
                            select at least one permission
                        </div>
                    </b-form-group>
                </b-col>
            </b-row>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <b-row>
                    <b-col>
                        <button class="btn btn-outline-light m-btn--pill pull-left m-btn--custom text-dark"
                                type="reset">Reset Form
                        </button>
                    </b-col>
                    <b-col>
                        <button
                            class="btn btn-success m-btn m-btn--pill m-btn--air pull-right m-btn--custom m-btn--icon"
                            type="submit">
                            <span><i class="la la-check"></i><span>Add Role</span></span></button>
                    </b-col>
                </b-row>

            </div>
        </div>
    </form>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import {Multiselect} from "vue-multiselect";
    import {mapActions, mapGetters} from 'vuex';
    import {minLength, required} from 'vuelidate/lib/validators';

    export default {
        components: {
            Loading,
            Multiselect
        },
        name: "roles-create",
        data() {
            return {
                isLoading: false,
                overlay: {
                    backgroundColor: "#000",
                    color: "#5867dd",
                    loader: "dots"
                },
                form: {
                    name: '',
                    guard: '',
                    permissions: [],
                },
                guards: [],
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
            form: {
                name: {required, minLength: minLength(4)},
                permissions: {required}
            }
        },
        computed: {
            ...mapGetters(['getRoles', 'getPermissions', 'getGuards', 'getErrors'])
        },
        methods: {
            ...mapActions(['FETCH_ROLES', 'FETCH_PERMISSIONS', 'ADD_ROLE']),
            validateInput(name) {
                const {$dirty, $error} = this.$v.form[name];
                return $dirty ? !$error : null;
            },
            setName(value) {
                this.form.name = value;
                this.$v.form.name.$touch();
            },
            nameFieldFocus() {
                this.serverErrors.errors.name = [];
            },
            onChange(event) {
                this.form.guard = event.target.value;
                this.form.permissions = [];
            },
            async onSubmit(event) {
                let payload = {
                    name: this.form.name,
                    guard: this.form.guard,
                    permissions: this.form.permissions
                };

                try {
                    this.isSubmitted = true;
                    this.$v.$touch();
                    if (!this.$v.form.permissions.$error) {
                        await this.$store.dispatch('ADD_ROLE', payload)
                            .then(() => {
                                this.serverErrors = JSON.parse(JSON.stringify(this.getErrors));
                                if (this.getErrors.message) {
                                    this.hasServerErrors = true;
                                    setTimeout(() => {
                                        this.hasServerErrors = false;
                                    }, 4500);
                                    return;
                                }

                                this.$swal({
                                    icon: 'success',
                                    title: 'Success',
                                    text:  'The incident was logged successfully!',
                                    timer: 5000,
                                    toast: true,
                                    timerProgressBar: true,
                                    position: 'top-end'
                                }).then(results=>{
                                    this.isLoading = false;
                                    let redirectUrl = this.getRoles[this.getRoles.length - 1].links._index;
                                    window.location.replace(redirectUrl);
                                })
                            });
                    }
                } catch (e) {

                }
            }

        },
        mounted() {
            this.FETCH_PERMISSIONS();
            this.FETCH_ROLES()
                .then(() => {
                    this.guards = this.getGuards;
                    this.form.guard = this.guards[0];
                });
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
    .multiselect--disabled .multiselect__select {
        height: 41px;
    }

    .multiselect, .multiselect__single {
        font-size: .95em !important
    }

    .multiselect__content-wrapper {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
