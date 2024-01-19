<script>
import Home from "../../../../generated-site/src/pages/Home.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateHome",
    components: {
        Head,
        Home,
    },
    props: {
        home_page: Object,
        property: Object,
        website: Object,
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <Head :title="'Home' + isPreview ? ' (preview)' : ''" />
    <Home
        :property="property"
        :website="website"
        :home_page="home_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
