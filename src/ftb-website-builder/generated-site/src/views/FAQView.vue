<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import FAQ from "@/pages/FAQ.vue";

export default {
    name: "FAQView",
    components: {
        FAQ,
    },
    computed: {
        ...mapState(useStore, [
            'faq_page',
            'property',
            'website',
            'routes',
        ]),
        formattedFAQPage() {
            let formattedData = this.deepClone(this.faq_page);
            formattedData.faq_page_section_image = this.formatImagePath(formattedData.faq_page_section_image);
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
    <FAQ
        :property="formattedProperty"
        :website="formattedWebsite"
        :faq_page="formattedFAQPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
