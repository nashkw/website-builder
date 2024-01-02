<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import Explore from "@/pages/Explore.vue";

export default {
    name: "ExploreView",
    components: {
        Explore,
    },
    computed: {
        ...mapState(useStore, [
            'explore_page',
            'property',
            'website',
            'routes',
        ]),
        formattedExplorePage() {
            let formattedData = this.deepClone(this.explore_page);
            formattedData.explore_page_section_image = this.formatImagePath(formattedData.explore_page_section_image);
            for (let attraction of formattedData.attractions) {
                attraction.attraction_image = this.formatImagePath(attraction.attraction_image);
            }
            return formattedData;
        },
        formattedProperty() {
            let formattedData = this.deepClone(this.property);
            formattedData.property_logo = this.formatImagePath(formattedData.property_logo);
            return formattedData;
        },
        formattedWebsite() {
            let formattedData = this.deepClone(this.website);
            formattedData.divider_art = this.formatImagePath(formattedData.divider_art);
            return formattedData;
        },
    },
    methods: {
        formatImagePath(path) {
            return path ? '/src/data/' + path : path;
        },
        deepClone(object) {
            return JSON.parse(JSON.stringify(object));
        }
    },
}
</script>

<template>
    <Explore
        :property="formattedProperty"
        :website="formattedWebsite"
        :explore_page="formattedExplorePage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
