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
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <AppHead
        v-if="isPreview"
        title="Explore (preview)"
    />
    <Head
        v-else
        :title="'Explore - ' + property.property_name"
    />
    <Explore
        :property="property"
        :website="website"
        :explore_page="explore_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
