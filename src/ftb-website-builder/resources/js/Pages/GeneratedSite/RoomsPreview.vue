<script>
import Rooms from "../../../../generated-site/src/pages/Rooms.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";
import About from "../../../../generated-site/src/pages/About.vue";

export default {
    name: "RoomsPreview",
    components: {
        About,
        Head,
        Rooms,
    },
    props: {
        rooms_page: Object,
        property: Object,
        website: Object,
    },
    data() {
        return {
            routes: {
                home: route('preview'),
                rooms: route('preview.rooms'),
                reviews: route('preview.reviews'),
                about: route('preview.about'),
                explore: route('preview.explore'),
                findus: route('preview.findus'),
                faq: route('preview.faq'),
            },
        }
    },
}
</script>

<template>
    <Head title="Rooms (preview)" />
    <Rooms
        :property="property"
        :website="website"
        :rooms_page="rooms_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
