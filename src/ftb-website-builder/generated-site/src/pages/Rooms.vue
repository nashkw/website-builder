<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";

export default {
    name: "Rooms",
    components: {
        BookingButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        rooms_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.rooms_page.rooms_page_section_header ?? "Rooms at " + this.property.property_name;
        },
    },
    methods: {
        roomImages(room) {
            let images = [];
            images.push({
                image: room.room_image_primary,
                description: room.room_image_primary_description,
            });
            for (const secondaryImage of room.secondary_room_images) {
                images.push({
                    image: secondaryImage.secondary_room_image,
                    description: secondaryImage.secondary_room_image_description,
                });
            }
            return images;
        },
    },
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >
        <PageSection
            :header="pageHeader"
            :paragraph="rooms_page.rooms_page_section_paragraph"
            :image="rooms_page.rooms_page_section_image"
            :image-description="rooms_page.rooms_page_section_image_description"
        />

        <PageSection
            v-for="room in rooms_page.rooms"
            :header="room.room_name"
            :paragraph="room.room_description"
            :images="roomImages(room)"
            :flipped="true"
        >
            <div class="flex justify-center">
                <BookingButton
                    text="Book a room"
                    booking-link=""
                    class="w-fit"
                />
            </div>
        </PageSection>
    </GeneratedSiteLayout>
</template>

<style scoped>
</style>
