<script>
import About from "../../../../generated-site/src/pages/About.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "AboutPreview",
    components: {
        Head,
        About,
    },
    props: {
        about_page: Object,
        property: Object,
        website: Object,
        routes: Object,
    },
}
</script>

<template>
    <Head title="About (preview)" />
    <About
        :property="property"
        :website="website"
        :about_page="about_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
