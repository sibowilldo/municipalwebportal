<template>
    <form @submit.prevent="" class="m-form m-form--fit m-form--label-align-right m-form--states">
        <div class="form-group m-form__group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="" :class="this.styles.inputText.css"/>
        </div>
        <div class="form-group m-form__group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="30" rows="10" class="" :class="this.styles.inputText.css"></textarea>
        </div>
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
        <div class="form-group m-form__group">
            <label for="location_description">Location Description:</label>
            <input type="text" name="location_description" id="location_description" class="" :class="this.styles.inputText.css"/>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group m-form__group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" name="longitude" id="longitude" class="" :class="this.styles.inputText.css"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group m-form__group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" name="latitude" id="latitude" class="" :class="this.styles.inputText.css"/>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group m--hide">
            <label for="suburb_id">Latitude:</label>
            <input type="hidden" name="suburb_id" id="suburb_id" class="" :class="this.styles.inputText.css"/>
        </div>
        <div class="form-group m-form__group">
            <label for="category">Categories:</label>
            <multiselect v-model="form.category" :options="categories" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a category"></multiselect>
        </div>
        <div class="form-group m-form__group">
            <label for="types">Types:</label>
            <multiselect v-model="form.type" :options="types" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a type"></multiselect>
        </div>
        <div class="form-group m-form__group">
            <label for="status_id">Statuses:</label>
            <multiselect v-model="form.status" :options="this.statuses" label="name" track-by="id" :searchable="true" :close-on-select="true" :show-labels="true" placeholder="Select a status"></multiselect>
        </div>
    </form>
</template>

<script>
    import {Multiselect} from "vue-multiselect";
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "incident-edit",
        components: {
            'multiselect': Multiselect,
        },
        data() {
            return {
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
                form: {
                    category: "",
                    type:"",
                    status: {id: 1, name: "Accepted"}
                },
                styles:{
                    inputText: {
                        css: "form-control m-input"
                    }
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
                    this.place = null;
                }
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
    .multiselect, .multiselect__single{
        font-size: .95em !important
    }
    .multiselect__content-wrapper {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
</style>
