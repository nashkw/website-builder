<script>
import FindUs from "../../../../generated-site/src/pages/FindUs.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "FindUsPreview",
    components: {
        About,
        Head,
        FindUs,
    },
    props: {
        find_us_page: Object,
        property: Object,
        website: Object,
        routes: Object,
    },
}
</script>

<template>
    <Head title="Find Us (preview)" />
    <FindUs
        :property="property"
        :website="website"
        :find_us_page="find_us_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
