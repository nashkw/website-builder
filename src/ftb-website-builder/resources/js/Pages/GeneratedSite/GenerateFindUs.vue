<script>
import FindUs from "../../../../generated-site/src/pages/FindUs.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateFindUs",
    components: {
        Head,
        FindUs,
    },
    props: {
        find_us_page: Object,
        property: Object,
        website: Object,
        routes: Object,
        isPreview: Boolean,
    },
}
</script>

<template>
    <Head :title="'Find Us' + isPreview ? ' (preview)' : ''" />
    <FindUs
        :property="property"
        :website="website"
        :find_us_page="find_us_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
