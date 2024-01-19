<script>
import Explore from "../../../../generated-site/src/pages/Explore.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateExplore",
    components: {
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
    <Head :title="'Explore' + isPreview ? ' (preview)' : ''" />
    <Explore
        :property="property"
        :website="website"
        :explore_page="explore_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
