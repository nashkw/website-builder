<script>
import Reviews from "../../../../generated-site/src/pages/Reviews.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "ReviewsPreview",
    components: {
        About,
        Head,
        Reviews,
    },
    props: {
        reviews_page: Object,
        property: Object,
        website: Object,
        routes: Object,
    },
}
</script>

<template>
    <Head title="Reviews (preview)" />
    <Reviews
        :property="property"
        :website="website"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
