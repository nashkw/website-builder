<script>
import Reviews from "../../../../generated-site/src/pages/Reviews.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "ReviewsPreview",
    components: {
        Head,
        Reviews,
    },
    props: {
        reviews_page: Object,
        property: Object,
    },
    data() {
        return {
            routes: {
                home: route('preview'),
                rooms: route('preview.rooms'),
                reviews: route('preview.reviews'),
                about: route('preview.about'),
                explore: route('preview.explore'),
                findus: route('preview.findus'),
                faq: route('preview.faq'),
            },
        }
    },
}
</script>

<template>
    <Head title="Reviews (preview)" />
    <Reviews
        :property="property"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
