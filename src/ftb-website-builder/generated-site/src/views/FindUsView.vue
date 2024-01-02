<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import FindUs from "@/pages/FindUs.vue";

export default {
    name: "FindUsView",
    components: {
        FindUs,
    },
    computed: {
        ...mapState(useStore, [
            'find_us_page',
            'property',
            'website',
            'routes',
        ]),
        formattedFindUsPage() {
            let formattedData = this.deepClone(this.find_us_page);
            formattedData.find_us_page_section_image = this.formatImagePath(formattedData.find_us_page_section_image);
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
    <FindUs
        :property="formattedProperty"
        :website="formattedWebsite"
        :find_us_page="formattedFindUsPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
