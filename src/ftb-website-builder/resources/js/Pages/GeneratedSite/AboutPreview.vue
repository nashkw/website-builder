<script>
import About from "../../../../generated-site/src/pages/About.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "AboutPreview",
    components: {
        Head,
        About,
    },
    props: {
        about_page: Object,
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
    <Head title="About (preview)" />
    <About
        :property="property"
        :about_page="about_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
