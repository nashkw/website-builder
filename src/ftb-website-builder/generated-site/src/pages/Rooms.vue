<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import LinkButton from "../components/Interactive/LinkButton.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";

export default {
    name: "Rooms",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        rooms_page: Object,
        routes: Object,
    },
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >
        <PageSection
            :header="rooms_page.rooms_page_section_header"
            :paragraph="rooms_page.rooms_page_section_paragraph"
            :image="rooms_page.rooms_page_section_image"
            :image-description="rooms_page.rooms_page_section_image_description"
        />

        <PageSection
            v-for="(room, index) in rooms_page.rooms"
            :header="room.room_name"
            :paragraph="room.room_description"
            :image="room.room_image_primary"
            :image-description="room.room_image_primary_description"
            :flipped="index % 2 === 0"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
