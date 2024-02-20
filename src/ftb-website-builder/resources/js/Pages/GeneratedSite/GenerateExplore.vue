<script>
import Explore from "../../../../generated-site/src/pages/Explore.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateExplore",
    components: {
        AppHead,
        Head,
        Explore,
    },
    props: {
        explore_page: Object,
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
        title="Explore (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'Explore - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <Explore
        :property="property"
        :website="website"
        :explore_page="explore_page"
        :page_flags="page_flags"
        :routes="routes"
    />
</template>

<style scoped>

</style>
