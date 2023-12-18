<script>
import {useStore} from "@/stores/store.js";
import {mapState} from "pinia";
import Home from "@/pages/Home.vue";
import GeneratedSiteLayout from "@/components/Structural/GeneratedSiteLayout.vue";

export default {
    name: "HomeView",
    components: {
        GeneratedSiteLayout,
        Home,
    },
    computed: {
        ...mapState(useStore, [
            'home_page',
            'property',
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
    },
    methods: {
        formatImagePath(path) {
            return '/src/data/' + path;
        },
        deepClone(object) {
            return JSON.parse(JSON.stringify(object));
        }
    },
}
</script>

<template>
    <Home
        :property="property"
        :home_page="formattedHomePage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
