<script>
import Reviews from "../../../../generated-site/src/pages/Reviews.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateReviews",
    components: {
        AppHead,
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
    <AppHead
        v-if="isPreview"
        title="Reviews (preview)"
    />
    <Head
        v-else
        :title="'Reviews - ' + property.property_name"
    />
    <Reviews
        :property="property"
        :website="website"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
