<script>
import Explore from "../../../../generated-site/src/pages/Explore.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "ExplorePreview",
    components: {
        About,
        Head,
        Explore,
    },
    props: {
        explore_page: Object,
        property: Object,
        website: Object,
        routes: Object,
    },
}
</script>

<template>
    <Head title="Explore (preview)" />
    <Explore
        :property="property"
        :website="website"
        :explore_page="explore_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
