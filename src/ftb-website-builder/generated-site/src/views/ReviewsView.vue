<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import Reviews from "@/pages/Reviews.vue";
import Home from "@/pages/Home.vue";

export default {
    name: "ReviewsView",
    components: {
        Home,
        Reviews,
    },
    computed: {
        ...mapState(useStore, [
            'reviews_page',
            'property',
            'routes',
        ]),
        formattedReviewsPage() {
            let formattedData = this.deepClone(this.reviews_page);
            formattedData.reviews_page_section_image = this.formatImagePath(formattedData.reviews_page_section_image);
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
    <Reviews
        :property="property"
        :reviews_page="formattedReviewsPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
