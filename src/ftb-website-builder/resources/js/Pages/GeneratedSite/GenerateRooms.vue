<script>
import Rooms from "../../../../generated-site/src/pages/Rooms.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import AppHead from "@/Layout/AppHead.vue";

export default {
    name: "GenerateRooms",
    components: {
        AppHead,
        Head,
        Rooms,
    },
    props: {
        rooms_page: Object,
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
        title="Rooms (preview)"
        :favicon="property.property_favicon"
    />
    <Head
        v-else
        :title="'Rooms - ' + property.property_name"
    >
        <link
            v-if="property.property_favicon"
            rel="icon"
            type="image/x-icon"
            :href="property.property_favicon"
        />
    </Head>
    <Rooms
        :property="property"
        :website="website"
        :rooms_page="rooms_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
