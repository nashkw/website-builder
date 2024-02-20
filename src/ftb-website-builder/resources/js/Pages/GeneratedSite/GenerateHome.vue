<script>
import Home from "../../../../generated-site/src/pages/Home.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateHome",
    components: {
        AppHead,
        Head,
        Home,
    },
    props: {
        home_page: Object,
        property: Object,
        website: Object,
        page_flags: Object,
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <AppHead
        v-if="isPreview"
        title="Home (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'Home - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <Home
        :property="property"
        :website="website"
        :home_page="home_page"
        :page_flags="page_flags"
        :routes="routes"
    />
</template>

<style scoped>

</style>
