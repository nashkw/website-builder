<script>
import Home from "../../../../generated-site/src/pages/Home.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "HomePreview",
    components: {
        About,
        Head,
        Home,
    },
    props: {
        home_page: Object,
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
    <Head title="Home (preview)" />
    <Home
        :property="property"
        :website="website"
        :home_page="home_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
