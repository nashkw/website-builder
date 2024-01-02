<script>
import {useStore} from "@/stores/store.js";
import {mapState} from "pinia";
import Home from "@/pages/Home.vue";

export default {
    name: "HomeView",
    components: {
        Home,
    },
    computed: {
        ...mapState(useStore, [
            'home_page',
            'property',
            'website',
            'routes',
        ]),
        formattedHomePage() {
            let formattedData = this.deepClone(this.home_page);
            formattedData.cover_image_primary = this.formatImagePath(formattedData.cover_image_primary);
            for (let image of formattedData.secondary_cover_images) {
                image.secondary_cover_image = this.formatImagePath(image.secondary_cover_image);
            }
            formattedData.intro_section_image = this.formatImagePath(formattedData.intro_section_image);
            formattedData.welcome_section_image = this.formatImagePath(formattedData.welcome_section_image);
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
    <Home
        :property="formattedProperty"
        :website="formattedWebsite"
        :home_page="formattedHomePage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
