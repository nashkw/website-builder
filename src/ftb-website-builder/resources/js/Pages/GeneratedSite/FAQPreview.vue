<script>
import FAQ from "../../../../generated-site/src/pages/FAQ.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "FAQPreview",
    components: {
        Head,
        FAQ,
    },
    props: {
        faq_page: Object,
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
    <Head title="FAQ (preview)" />
    <FAQ
        :property="property"
        :faq_page="faq_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
