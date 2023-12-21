<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import Explore from "@/pages/Explore.vue";
import Home from "@/pages/Home.vue";

export default {
    name: "ExploreView",
    components: {
        Home,
        Explore,
    },
    computed: {
        ...mapState(useStore, [
            'explore_page',
            'property',
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
        :property="property"
        :explore_page="formattedExplorePage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
