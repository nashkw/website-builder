<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import Reviews from "@/pages/Reviews.vue";

export default {
    name: "ReviewsView",
    components: {
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
    <Reviews
        :property="formattedProperty"
        :reviews_page="formattedReviewsPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
