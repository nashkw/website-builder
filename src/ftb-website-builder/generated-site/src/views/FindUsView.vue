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
            'routes',
        ]),
        formattedFindUsPage() {
            let formattedData = this.deepClone(this.find_us_page);
            formattedData.find_us_page_section_image = this.formatImagePath(formattedData.find_us_page_section_image);
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
        :property="property"
        :find_us_page="formattedFindUsPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
