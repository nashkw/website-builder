<script>
import FAQ from "../../../../generated-site/src/pages/FAQ.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateFAQ",
    components: {
        Head,
        FAQ,
    },
    props: {
        faq_page: Object,
        property: Object,
        website: Object,
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <Head :title="'FAQ' + isPreview ? ' (preview)' : ''" />
    <FAQ
        :property="property"
        :website="website"
        :faq_page="faq_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
