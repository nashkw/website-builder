<script>
import FindUs from "../../../../generated-site/src/pages/FindUs.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateFindUs",
    components: {
        AppHead,
        Head,
        FindUs,
    },
    props: {
        find_us_page: Object,
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
        title="Find Us (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'Find Us - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <FindUs
        :property="property"
        :website="website"
        :find_us_page="find_us_page"
        :page_flags="page_flags"
        :routes="routes"
    />
</template>

<style scoped>

</style>
