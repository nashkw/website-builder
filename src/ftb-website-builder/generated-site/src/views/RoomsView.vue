<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import Rooms from "@/pages/Rooms.vue";

export default {
    name: "RoomsView",
    components: {
        Rooms,
    },
    computed: {
        ...mapState(useStore, [
            'rooms_page',
            'property',
            'website',
            'routes',
        ]),
        formattedRoomsPage() {
            let formattedData = this.deepClone(this.rooms_page);
            formattedData.rooms_page_section_image = this.formatImagePath(formattedData.rooms_page_section_image);
            for (let room of formattedData.rooms) {
                room.room_image_primary = this.formatImagePath(room.room_image_primary);
                for (let image of room.secondary_room_images) {
                    image.secondary_room_image = this.formatImagePath(image.secondary_room_image);
                }
            }
            return formattedData;
        },
        formattedProperty() {
            let formattedData = this.deepClone(this.property);
            formattedData.property_logo = this.formatImagePath(formattedData.property_logo);
            return formattedData;
        },
        formattedWebsite() {
            let formattedData = this.deepClone(this.website);
            formattedData.divider_art = this.formatImagePath(formattedData.divider_art);
            return formattedData;
        },
    },
    methods: {
        formatImagePath(path) {
            return path ? '/src/data/' + path : path;
        },
        deepClone(object) {
            return JSON.parse(JSON.stringify(object));
        },
    },
}
</script>

<template>
    <Rooms
        :property="formattedProperty"
        :website="formattedWebsite"
        :rooms_page="formattedRoomsPage"
        :routes="routes"
    />
</template>

<style scoped>

</style>
