<script>
import About from "../../../../generated-site/src/pages/About.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateAbout",
    components: {
        AppHead,
        Head,
        About,
    },
    props: {
        about_page: Object,
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
        title="About (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'About - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <About
        :property="property"
        :website="website"
        :about_page="about_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
