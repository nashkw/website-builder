<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";
import tinycolor from "tinycolor2";

export default {
    name: "Rooms",
    components: {
        BookingButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        rooms_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.rooms_page.rooms_page_section_header ?? "Rooms at " + this.property.property_name;
        },
        colours() {
            return {
                accentPrimary: tinycolor(this.website.primary_colour),
                accentPrimaryAlt: tinycolor(this.website.primary_colour).darken(),
                accentSecondary: tinycolor(this.website.secondary_colour),
                accentSecondaryAlt: tinycolor(this.website.secondary_colour).darken(),
                title: tinycolor(this.website.text_colour),
                subtitle: tinycolor(this.website.text_colour).lighten(),
                text: tinycolor(this.website.text_colour).lighten().lighten(),
                background: tinycolor(this.website.background_colour),
                backgroundAlt: tinycolor.mix(
                    tinycolor(this.website.background_colour),
                    tinycolor(this.website.secondary_colour),
                    7
                ),
            };
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
            :imageDescription="rooms_page.rooms_page_section_image_description"
            :dividerArt="website.divider_art"
        />

        <PageSection
            v-for="room in rooms_page.rooms"
            :header="room.room_name"
            :paragraph="room.room_description"
            :images="roomImages(room)"
            :flipped="true"
            :subtitle="true"
        >
            <div class="flex justify-center">
                <BookingButton
                    text="Book a room"
                    :bookingLink="property.property_booking_link"
                    class="w-fit"
                />
            </div>
        </PageSection>
    </GeneratedSiteLayout>
</template>

<style scoped>
* {
    --gs-colour-accent-primary: v-bind('colours.accentPrimary');
    --gs-colour-accent-primary-alt: v-bind('colours.accentPrimaryAlt');
    --gs-colour-accent-secondary: v-bind('colours.accentSecondary');
    --gs-colour-accent-secondary-alt: v-bind('colours.accentSecondaryAlt');
    --gs-colour-title: v-bind('colours.title');
    --gs-colour-subtitle: v-bind('colours.subtitle');
    --gs-colour-text: v-bind('colours.text');
    --gs-colour-background: v-bind('colours.background');
    --gs-colour-background-alt: v-bind('colours.backgroundAlt');
    --gs-input-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
</style>
