<script>
import FAQ from "../../../../generated-site/src/pages/FAQ.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "FAQPreview",
    components: {
        About,
        Head,
        FAQ,
    },
    props: {
        faq_page: Object,
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
    <Head title="FAQ (preview)" />
    <FAQ
        :property="property"
        :website="website"
        :faq_page="faq_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
