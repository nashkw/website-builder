<script>
import Reviews from "../../../../generated-site/src/pages/Reviews.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateReviews",
    components: {
        AppHead,
        Head,
        Reviews,
    },
    props: {
        reviews_page: Object,
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
        title="Reviews (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'Reviews - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <Reviews
        :property="property"
        :website="website"
        :reviews_page="reviews_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
