<script>
import Rooms from "../../../../generated-site/src/pages/Rooms.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "GenerateRooms",
    components: {
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
    <Head :title="'Rooms' + isPreview ? ' (preview)' : ''" />
    <Rooms
        :property="property"
        :website="website"
        :rooms_page="rooms_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
