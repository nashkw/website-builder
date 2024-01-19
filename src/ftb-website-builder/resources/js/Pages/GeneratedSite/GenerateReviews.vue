<script>
import Reviews from "../../../../generated-site/src/pages/Reviews.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateReviews",
    components: {
        Head,
        Reviews,
    },
    props: {
        reviews_page: Object,
        property: Object,
        website: Object,
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <Head :title="'Reviews' + isPreview ? ' (preview)' : ''" />
    <Reviews
        :property="property"
        :website="website"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
