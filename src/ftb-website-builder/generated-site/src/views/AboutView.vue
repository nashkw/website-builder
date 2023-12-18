<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import About from "@/pages/About.vue";
import Home from "@/pages/Home.vue";

export default {
    name: "AboutView",
    components: {
        Home,
        About,
    },
    computed: {
        ...mapState(useStore, [
            'about_page',
            'property',
            'routes',
        ]),
        formattedAboutPage() {
            let formattedData = this.deepClone(this.about_page);
            formattedData.about_page_section_image = this.formatImagePath(formattedData.about_page_section_image);
            for (let section of formattedData.secondary_about_sections) {
                section.secondary_about_section_image = this.formatImagePath(section.secondary_about_section_image);
            }
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
    <About
        :property="property"
        :about_page="formattedAboutPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
