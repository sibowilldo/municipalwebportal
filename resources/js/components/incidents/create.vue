<template>
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
                <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                    <b-form @reset="onReset" class="m-form">
                        <form-wizard shape="tab" step-size="md" subtitle="" color="#28293C" @on-complete="onComplete">
                            <div class="m-portlet__head" slot="title">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Log Incident
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <tab-content title="Incident details" icon="la la-warning">
                                <div class="m-portlet__body">
                                    <b-form-group label="Visibility:" label-for="is_public">
                                        <b-form-radio-group
                                            id="is-public"
                                            v-model="form.is_public"
                                            :options="[{'text':'Log as PUBLIC', 'value':true},{'text':'Log as PRIVATE','value':false}]"
                                            stacked
                                            plain
                                            name="is_public"/>
                                    </b-form-group>
                                    <b-form-group label="Summary:" label-for="name">
                                        <b-form-input id="name" size="lg" type="text" v-model.trim="$v.form.name.$model"
                                                      :state="validateInput('name')">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="name-live-feedback"
                                        >Name is a required field and must be min of 3 and max of 100 characters.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Description:" label-for="description">
                                        <b-form-textarea id="description" max-rows="6"
                                                         rows="6" v-model.trim="form.description"
                                                         :state="validateInput('description')">
                                        </b-form-textarea>
                                        <b-form-invalid-feedback
                                            id="description-live-feedback"
                                        >Description is a required field and must be min of 10 and max of 500 characters.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <div class="form-group m-form__group">
                                        <div class="mb-3">
                                            <label for="searchMapInput">Search Location</label>
                                            <gmap-autocomplete :options="autocompleteOptions" @place_changed="setPlace"
                                                               class="m-input form-control mb-3 form-control-lg">
                                            </gmap-autocomplete>
                                            <GmapMap
                                                :center="marker.position"
                                                :zoom="15"
                                                ref="mapRef"
                                                style="width: 100%; height: 300px"
                                            >
                                                <GmapMarker
                                                    :clickable="true"
                                                    :draggable="true"
                                                    :position="marker.position"
                                                    @click="center=marker.position"
                                                    @dragend="setDragPlace"
                                                />
                                            </GmapMap>
                                        </div>
                                    </div>
                                    <b-form-group label="Location Description:" label-for="location_description">
                                        <b-form-input id="location_description" size="lg"
                                                      :state="validateInput('location_description')"
                                                      type="text" v-model.trim="$v.form.location_description.$model">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="location-description-live-feedback"
                                        >Location Description is a required field and must be min of 10 and max of 255 characters.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-row>
                                        <b-col>
                                            <b-form-group label="Latitude:" label-for="latitude">
                                                <b-form-input id="latitude" size="lg" type="text" v-model.trim="$v.form.latitude.$model"
                                                              :state="validateInput('latitude')">
                                                </b-form-input>
                                                <b-form-invalid-feedback
                                                    id="latitude-live-feedback"
                                                >Latitude is a required field.
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </b-col>
                                        <b-col>
                                            <b-form-group label="Longitude:" label-for="longitude">
                                                <b-form-input id="longitude" size="lg" type="text"
                                                              :state="validateInput('longitude')"
                                                              v-model.trim="$v.form.longitude.$model">
                                                </b-form-input>
                                                <b-form-invalid-feedback
                                                    id="longitude-live-feedback"
                                                >Longitude is a required .
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                    <b-form-group label="Category:" label-for="category_id" :state="validateInput('category')">
                                        <b-row>
                                            <b-col>
                                                <multiselect label="name" placeholder="Select a category" track-by="id"
                                                             v-model.trim="$v.form.category.$model"
                                                             :close-on-select="true" :options="this.categories" :searchable="true"
                                                             :show-labels="true"
                                                             @select="onSelectedCategory"
                                                             @remove="onRemoveCategory">
                                                </multiselect>
                                            </b-col>
                                        </b-row>
                                        <b-form-invalid-feedback id="category-live-feedback">
                                            Please select a category.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Type:" label-for="type_id" :state="validateInput('type')">
                                        <multiselect :close-on-select="true" :options="this.types" :searchable="true"
                                                     :show-labels="true"
                                                     label="name" placeholder="Select a type" track-by="id"
                                                     v-model.trim="$v.form.type.$model" :disabled="this.form.category==null"></multiselect>
                                        <b-form-invalid-feedback id="type-live-feedback">
                                            Please select a type.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Status:" label-for="status_id" :state="validateInput('status')">
                                    <multiselect :close-on-select="true" :options="this.statuses" :searchable="true"
                                                 :show-labels="true"
                                                 label="name" placeholder="Select a status" track-by="id"
                                                 v-model.trim="$v.form.status.$model"></multiselect>
                                        <b-form-invalid-feedback id="status-live-feedback">
                                            Please select a status.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                </div>
                            </tab-content>
                            <tab-content title="User Details" icon="la la-user" v-if="!form.is_public">
                                <div class="m-portlet__body">
                                    <b-form-group label="First Name:" label-for="firstname">
                                        <b-form-input id="firstname" size="lg" type="text" v-model.trim="$v.form.firstname.$model"
                                                      :state="validateInput('firstname')">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="firstname-live-feedback"
                                        >First Name is required.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Last Name:" label-for="laststname">
                                        <b-form-input id="lastname" size="lg" type="text" v-model.trim="$v.form.lastname.$model"
                                                      :state="validateInput('lastname')">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="lastname-live-feedback"
                                        >Last Name is required.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Contact Number:" label-for="contactnumber">
                                        <b-form-input id="contactnumber" size="lg" type="text" v-model.trim="$v.form.contactnumber.$model"
                                                      :state="validateInput('contactnumber')">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="contactnumber-live-feedback"
                                        >Contact Number is required.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                    <b-form-group label="Email Address:" label-for="email">
                                        <b-form-input id="email" size="lg" type="text" v-model.trim="$v.form.email.$model"
                                                      :state="validateInput('email')">
                                        </b-form-input>
                                        <b-form-invalid-feedback
                                            id="email-live-feedback"
                                        >Email Address Format.
                                        </b-form-invalid-feedback>
                                    </b-form-group>
                                </div>
                            </tab-content>
                        </form-wizard>
                        </b-form>
                        <div class="m-alert m-alert--icon alert alert-danger m-alert--square mb-0" role="alert"
                             v-if="this.$v.form.$anyError || this.errors">
                            <div class="m-alert__icon">
                                <i class="la la-warning"/>
                            </div>
                            <div class="m-alert__text" v-if="this.$v.form.$anyError">
                                <strong>Invalid Form Inputs! </strong> Please check that all fields were filled correctly, and at least one option selected from each select field.
                            </div>
                            <div class="m-alert__text" v-if="this.errors">
                                <strong>Oh snap! </strong> {{ this.errors.message }}
                                <div v-for="error in this.errors.errors">
                                    <span> {{ error[0]}}</span>
                                </div>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</template>

<script>

    import {FormWizard, TabContent} from 'vue-form-wizard';
    import {Multiselect} from "vue-multiselect";
    import {mapActions, mapGetters} from 'vuex';
    import {maxLength, minLength, required, requiredIf, email, helpers} from 'vuelidate/lib/validators';
    import moment from "moment";
    import 'vue-form-wizard/dist/vue-form-wizard.min.css';

    const selected = (param) => !(param == null);

    export default {
        name: "incident-create",
        components: {
            FormWizard,
            TabContent,
            'multiselect': Multiselect
        },
        validations: {
            form: {
                name: {required, maxLength: maxLength(100), minLength: minLength(3)},
                description: {required, maxLength: maxLength(500)},
                location_description: {required, maxLength: maxLength(255)},
                latitude: {required, maxLength: maxLength(20)},
                longitude: {required, maxLength: maxLength(20)},
                category: {selected},
                type: {selected},
                status: {selected},
                firstname:{
                    required: requiredIf(function (model) {
                        return !model.is_public
                    })},
                lastname:{
                    required: requiredIf(function (model) {
                        return !model.is_public
                    })},
                contactnumber:{
                    required: requiredIf(function (model) {
                        return !model.is_public
                    })},
                email:{email},
            }
        },
        data() {
            return {
                isLoading: false,
                isSubmitted: false,
                types: [],
                errors: null,
                autocompleteOptions: {
                    componentRestrictions: {
                        country: [
                            'za',
                        ],
                    },
                },
                marker: {
                    position: {
                        lat: -29.84790876,
                        lng: 31.01342899
                    }
                },
                form: {
                    is_public: true,
                    name: '', //Burst Sewage Pipe
                    description: '', //Montclair has a burst sewage pipe by Engen Garage Roland Champ Street
                    location_description: '', //Roland Chapman Dr, Montclair, Durban, 4004
                    longitude: '', //30.974585
                    latitude: '', //-29.92268799999999
                    category: null,
                    type: null,
                    status: null,
                    firstname: '',
                    lastname:'', //Msomi
                    contactnumber:'', //0812345678
                    email:'', //someone@provider.com

                }
            }
        },
        computed: {
            ...mapGetters({
                statuses: 'getStatuses',
                categories: 'getCategories',
                incidents: 'getIncidents',
            })
        },
        methods: {
            ...mapActions(['FETCH_STATUSES', 'FETCH_CATEGORIES', 'SAVE_INCIDENT']),
            validateInput(name) {
                const {$dirty, $error} = this.$v.form[name];
                return $dirty ? !$error : null;
            },
            setDragPlace(place){
                this.form.location_description = place.latLng.toString();
                this.form.longitude = place.latLng.lng();
                this.form.latitude = place.latLng.lat();
            },
            setPlace(place) {
                this.place = place;
                this.usePlace(this.place);
            },
            usePlace(place) {
                if (this.place) {
                    this.marker = {
                        position: {
                            lat: this.place.geometry.location.lat(),
                            lng: this.place.geometry.location.lng(),
                        }
                    };
                    this.$refs.mapRef.$mapPromise.then((map) => {
                        map.panTo({
                            lat: place.geometry.location.lat(),
                            lng: place.geometry.location.lng(),
                        })
                    });
                    this.form.location_description = place.formatted_address;
                    this.form.longitude = place.geometry.location.lng();
                    this.form.latitude = place.geometry.location.lat();
                    this.place = null;
                }
            },
            onSelectedCategory(data, id) {
                this.types = JSON.parse(JSON.stringify(data.types));
            },
            onRemoveCategory() {
                this.types = [];
                this.form.type_id = null;
            },
            async onComplete(){
                try {
                    this.$v.form.$touch();
                    if (this.$v.form.$anyError) {
                        console.log(this.$v.form);
                        return;
                    }

                    let loader = this.$loading.show();
                    let payload = {
                        reference: moment().unix(),
                        name: this.form.name,
                        description: this.form.description,
                        location_description: this.form.location_description,
                        longitude: this.form.longitude.toString(),
                        latitude: this.form.latitude.toString(),
                        category_id: this.form.category.id,
                        type_id: this.form.type.id,
                        status_id: this.form.status.id,
                        suburb_id: 0,
                        is_public: this.form.is_public,
                        firstname: this.form.firstname,
                        lastname:this.form.lastname,
                        contactnumber:this.form.contactnumber,
                        email:this.form.email,
                    };

                    await axios.post('/api/v1/incidents', payload)
                        .then(response => {
                            let incident = response.data.data;
                            this.$store.commit('addIncident',incident)
                            this.$swal({
                                icon: 'success',
                                title: 'Success',
                                text:  'The incident was logged successfully!'
                            }).then(results=>{
                                loader.hide();
                                window.location.assign(incident.links._self);
                            })
                        })
                        .catch(error => {
                            loader.hide();
                            return Promise.reject(error);
                        });
                } catch (e) {
                    this.errors = e.response.data;
                }
            },
            onReset() {
                // Reset form values
                this.form = {
                    name: '',
                    description: '',
                    location_description: '',
                    longitude: '',
                    latitude: '',
                    category: null,
                    type: null,
                    status: null,
                    is_public: true
                };
            },
            onLaunchSwal(){
                console.log('Drag ended!')
                this.$swal({
                    icon: 'success',
                    title: 'Yeah, Fine',
                    text:  'It\'s Done',
                    timer: 5000,
                    toast: true,
                    position: 'top-end'
                })
            }
        },
        mounted() {
            this.FETCH_CATEGORIES();
            this.FETCH_STATUSES();
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .wizard-header{
        padding: 0 !important;
    }
    .multiselect--disabled .multiselect__select {
        height: 41px;
    }

    .multiselect, .multiselect__single {
        font-size: .95em !important
    }

    .multiselect__content-wrapper {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }
</style>
