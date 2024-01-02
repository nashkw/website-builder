<script>
import FindUs from "../../../../generated-site/src/pages/FindUs.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "FindUsPreview",
    components: {
        About,
        Head,
        FindUs,
    },
    props: {
        find_us_page: Object,
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
    <Head title="Find Us (preview)" />
    <FindUs
        :property="property"
        :website="website"
        :find_us_page="find_us_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
