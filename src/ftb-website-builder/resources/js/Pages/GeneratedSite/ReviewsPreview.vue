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
        :website="website"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
