<script>
import Explore from "../../../../generated-site/src/pages/Explore.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "ExplorePreview",
    components: {
        About,
        Head,
        Explore,
    },
    props: {
        explore_page: Object,
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
    <Head title="Explore (preview)" />
    <Explore
        :property="property"
        :website="website"
        :explore_page="explore_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
