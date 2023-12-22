<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import About from "@/pages/About.vue";

export default {
    name: "AboutView",
    components: {
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
        formattedProperty() {
            let formattedData = this.deepClone(this.property);
            formattedData.property_logo = this.formatImagePath(formattedData.property_logo);
            return formattedData;
        }
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
    <About
        :property="formattedProperty"
        :about_page="formattedAboutPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
