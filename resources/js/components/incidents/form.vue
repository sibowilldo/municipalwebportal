<template>
    <div class="vld-parent">
        <loading :active.sync="isLoading"
                 :background-color='overlay.backgroundColor'
                 :can-cancel="true"
                 :color='overlay.color'
                 :is-full-page="true"
                 :loader="overlay.loader"></loading>
        <b-form @reset="onReset" @submit.stop.prevent="onSubmit" v-if="show">
            <b-form-group label="Name:" label-for="name">
                <b-form-input id="name" required type="text" v-model="form.name" size="lg">
                </b-form-input>
            </b-form-group>
            <b-form-group label="Description:" label-for="description">
                <b-form-textarea id="description" v-model="form.description"
                rows="6" max-rows="6">
                </b-form-textarea>
            </b-form-group>
            <div class="form-group m-form__group">
                <div class="mb-3">
                    <label for="searchMapInput">Search Location</label>
                    <gmap-autocomplete class="m-input form-control mb-3" @place_changed="setPlace" :options="autocompleteOptions">
                    </gmap-autocomplete>
                    <GmapMap
                        :center="marker.position"
                        :zoom="15"
                        style="width: 100%; height: 300px"
                        ref="mapRef"
                    >
                        <GmapMarker
                            :position="marker.position"
                            :clickable="true"
                            :draggable="true"
                            @click="center=marker.position"
                        />
                    </GmapMap>
                </div>
            </div>
            <b-form-group label="Location Description:" label-for="location_description">
                <b-form-input id="location_description" required type="text" v-model="form.location_description" size="lg">
                </b-form-input>
            </b-form-group>
            <b-row>
                <b-col>
                    <b-form-group label="Longitude:" label-for="longitude">
                        <b-form-input id="longitude" required type="text" v-model="form.longitude" size="lg">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group label="Latitude:" label-for="latitude">
                        <b-form-input id="latitude" required type="text" v-model="form.latitude" size="lg">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-form-group label="Category:" label-for="category_id">
                <multiselect v-model="form.category_id" :options="this.categories" label="name" track-by="id" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a Category"></multiselect>
            </b-form-group>
            <b-form-group label="Type:" label-for="type_id">
                <multiselect v-model="form.type_id" :options="this.types" label="name" track-by="id" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a Type"></multiselect>
            </b-form-group>
            <b-form-group label="Status:" label-for="status_id">
                <multiselect v-model="form.status_id" :options="this.statuses" label="name" track-by="id" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a Status"></multiselect>
            </b-form-group>
        </b-form>
    </div>
</template>

<script>

    import Loading from 'vue-loading-overlay';
    import {Multiselect} from "vue-multiselect";
    import { mapGetters, mapActions } from 'vuex';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        name: "IncidentForm",
        components: {
            'multiselect': Multiselect,
            Loading
        },
        mounted() {
            this.FETCH_CATEGORIES();
            this.FETCH_STATUSES();
            this.$events.$on('submit-incident', eventData => this.onSubmitIncident(eventData));
        },
        data() {
            return {
                show: true,
                isLoading: false,
                autocompleteOptions: {
                    componentRestrictions: {
                        country: [
                            'za',
                        ],
                    },
                },
                marker: {
                    position:{
                        lat: -29.84790876,
                        lng: 31.01342899
                    }
                },
                overlay: {
                    backgroundColor: "#000",
                    color: "#fff",
                    loader: "dots"
                },
                form: {
                    name: '',
                    description: '',
                    location_description: '',
                    longitude: '',
                    latitude: '',
                    category_id: null,
                    type_id: null,
                    status_id: null
                }
            }
        },
        computed: {
            ...mapGetters({
                statuses: 'getStatuses',
                categories: 'getCategories',
                types: 'getTypes'
            })
        },
        methods: {
            ...mapActions(['FETCH_STATUSES', 'FETCH_CATEGORIES', 'FETCH_TYPES']),
            setPlace(place) {
                console.log(place)
                this.place = place;
                this.usePlace(this.place);
            },
            usePlace(place) {
                if (this.place) {
                    this.marker= {
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
                    this.place = null;
                }
            },
            onSubmitIncident() {
                console.log(this.form);
                this.isLoading = true;
                setTimeout(() => {
                    this.$root.$emit('bv::hide::modal', 'report-incident');
                    this.isLoading = false;
                }, 1000)
            },
            onReset(evt) {
                evt.preventDefault();
                // Reset our form values
                this.form.name = '';
                this.form.description = '';
                this.form.location_description = '';
                this.form.longitude = '';
                this.form.latitude = '';
                this.form.category_id = null;
                this.form.type_id = null;
                this.form.status_id = null;
                this.show = false;
                this.$nextTick(() => {
                    this.show = true
                })
            }
        }
    }
</script>

<style scoped>

</style>
