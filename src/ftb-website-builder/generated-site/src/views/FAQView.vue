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
            'routes',
        ]),
        formattedFAQPage() {
            let formattedData = this.deepClone(this.faq_page);
            formattedData.faq_page_section_image = this.formatImagePath(formattedData.faq_page_section_image);
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
        :property="property"
        :faq_page="formattedFAQPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
