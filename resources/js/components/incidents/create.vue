<template>
    <div class="row">
        <loading :active.sync="isLoading"
                 :background-color='overlay.backgroundColor'
                 :can-cancel="true"
                 :color='overlay.color'
                 :is-full-page="true"
                 :loader="overlay.loader"/>
        <div class="col-xl-8 offset-xl-2">
            <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Incident Details
                            </h3>
                        </div>
                    </div>
                </div>
                <b-form @reset="onReset" @submit.stop.prevent="onSubmitIncident" class="m-form">
                    <div class="m-portlet__body">
                        <b-form-group label="Visibility:" label-for="is_public">
                            <b-form-radio-group
                                id="btn-radios-2"
                                v-model="form.is_public"
                                :options="[{'text':'Public', 'value':true},{'text':'Private','value':false}]"
                                buttons
                                button-variant="outline-dark"
                                name="is_public"/>
                        </b-form-group>
                        <b-form-group label="Name:" label-for="name">
                            <b-form-input id="name" size="lg" type="text" v-model.trim="form.name"
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
                                    />
                                </GmapMap>
                            </div>
                        </div>
                        <b-form-group label="Location Description:" label-for="location_description">
                            <b-form-input id="location_description" size="lg"
                                          :state="validateInput('location_description')"
                                          type="text" v-model.trim="form.location_description">
                            </b-form-input>
                            <b-form-invalid-feedback
                                id="location-description-live-feedback"
                            >Location Description is a required field and must be min of 10 and max of 255 characters.
                            </b-form-invalid-feedback>
                        </b-form-group>
                        <b-row>
                            <b-col>
                                <b-form-group label="Longitude:" label-for="longitude">
                                    <b-form-input id="longitude" size="lg" type="text"
                                                  :state="validateInput('longitude')"
                                                  v-model.trim="form.longitude">
                                    </b-form-input>
                                    <b-form-invalid-feedback
                                        id="longitude-live-feedback"
                                    >Longitude is a required .
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </b-col>
                            <b-col>
                                <b-form-group label="Latitude:" label-for="latitude">
                                    <b-form-input id="latitude" size="lg" type="text" v-model.trim="form.latitude"
                                                  :state="validateInput('latitude')">
                                    </b-form-input>
                                    <b-form-invalid-feedback
                                        id="latitude-live-feedback"
                                    >Latitude is a required field.
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </b-col>
                        </b-row>
                        <b-form-group label="Category:" label-for="category_id" :state="validateInput('category')">
                            <multiselect label="name" placeholder="Select a category" track-by="id"
                                         v-model.trim="form.category"
                                         :close-on-select="true" :options="this.categories" :searchable="true"
                                         :show-labels="true"
                                         @select="onSelectedCategory"
                                         @remove="onRemoveCategory">
                            </multiselect>
                        </b-form-group>
                        <b-form-group label="Type:" label-for="type_id" :state="validateInput('type')">
                            <multiselect :close-on-select="true" :options="this.types" :searchable="true"
                                         :show-labels="true"
                                         label="name" placeholder="Select a type" track-by="id"
                                         v-model.trim="form.type" :disabled="this.form.category==null"/>
                        </b-form-group>
                        <b-form-group label="Status:" label-for="status_id" :state="validateInput('status')">
                            <multiselect :close-on-select="true" :options="this.statuses" :searchable="true"
                                         :show-labels="true"
                                         label="name" placeholder="Select a status" track-by="id"
                                         v-model.trim="form.status"/>
                        </b-form-group>
                    </div>
                    <div class="m-alert m-alert--icon alert alert-danger m-alert--square mb-0" role="alert"
                         v-if="this.errors">
                        <div class="m-alert__icon">
                            <i class="la la-warning"/>
                        </div>
                        <div class="m-alert__text">
                            <strong>Oh snap! </strong> {{ this.errors.message }}
                            <div v-for="error in this.errors.errors">
                                <span> {{ error[0]}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-alert m-alert--icon alert alert-danger m-alert--square mb-0" role="alert"
                         v-if="this.$v.form.$anyError">
                        <div class="m-alert__icon">
                            <i class="la la-warning"/>
                        </div>
                        <div class="m-alert__text">
                            <strong>Invalid Form Inputs! </strong> Please check that all fields were filled correctly.
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <b-row>
                                <b-col>
                                    <button class="btn m-btn--pill btn-light  m-btn pull-left" @click.prevent="onReset"
                                            type="button"> Clear Form
                                    </button>
                                    <button class="btn btn-success m-btn--pill m-btn--icon pull-right m-btn--air"
                                            type="submit">
                                        <!--                                        :disabled="(this.form.type == null || this.form.category == null || this.form.status == null)"-->
                                        <span>
                                        <i class="la la-check"/>
                                        <span>Save Incident</span>
                                    </span></button>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import {Multiselect} from "vue-multiselect";
    import {mapActions, mapGetters} from 'vuex';
    import {maxLength, minLength, required} from 'vuelidate/lib/validators';
    import moment from "moment";

    export default {
        name: "incident-create",
        components: {
            'multiselect': Multiselect,
            Loading
        },
        validations: {
            form: {
                name: {required, maxLength: maxLength(100), minLength: minLength(3)},
                description: {required, maxLength: maxLength(500)},
                location_description: {required, maxLength: maxLength(255)},
                latitude: {required, maxLength: maxLength(20)},
                longitude: {required, maxLength: maxLength(20)},
                category: {required},
                type: {required},
                status: {required}
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
                overlay: {
                    backgroundColor: "#fff",
                    color: "#5867dd",
                    loader: "dots"
                },
                form: {
                    is_public: true,
                    name: '',
                    description: 'Because I is lazy AF to type these 2 fields',
                    location_description: '',
                    longitude: '',
                    latitude: '',
                    category: null,
                    type: null,
                    status: null
                }
            }
        },
        computed: {
            ...mapGetters({
                statuses: 'getStatuses',
                categories: 'getCategories',
            })
        },
        methods: {
            ...mapActions(['FETCH_STATUSES', 'FETCH_CATEGORIES', 'SAVE_INCIDENT']),
            validateInput(name) {
                const {$dirty, $error} = this.$v.form[name];
                return $dirty ? !$error : null;
            },
            setPlace(place) {
                console.log(place);
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
            async onSubmitIncident() {
                this.isSubmitted = true;
                this.$v.form.$touch();
                if (this.$v.form.$error) {
                    return;
                }
                try {
                    this.isLoading = true;
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
                        suburb_id: 0
                    };
                    await this.$store.dispatch('SAVE_INCIDENT', payload)
                        .then(() => {
                            this.$notify("Incident logged successfully!", "success");
                            this.errors = null;
                        });
                } catch (e) {
                    this.errors = e.response.data;
                }
                setTimeout(() => {
                    this.isLoading = false;
                }, 1000)
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
                    status: null
                };
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
