<script>
import FAQ from "../../../../generated-site/src/pages/FAQ.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateFAQ",
    components: {
        AppHead,
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
    <AppHead
        v-if="isPreview"
        title="FAQ (preview)"
    />
    <Head
        v-else
        :title="'FAQ - ' + property.property_name"
    />
    <FAQ
        :property="property"
        :website="website"
        :faq_page="faq_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
