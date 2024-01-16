<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import LinkButton from "../components/Interactive/LinkButton.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";
import GeneratedSiteCarousel from "../components/Interactive/GeneratedSiteCarousel.vue";
import {Carousel} from "vue3-carousel";
import tinycolor from 'tinycolor2'

export default {
    name: "Home",
    components: {
        Carousel,
        GeneratedSiteCarousel,
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        home_page: Object,
        routes: Object,
    },
    computed: {
        coverImages() {
            let images = [];
            images.push({
                image: this.home_page.cover_image_primary,
                description: this.home_page.cover_image_primary_description,
            });
            for (const secondaryImage of this.home_page.secondary_cover_images) {
                images.push({
                    image: secondaryImage.secondary_cover_image,
                    description: secondaryImage.secondary_cover_image_description,
                });
            }
            return images;
        },
        welcomeHeader() {
            return this.home_page.welcome_section_header ?? "Welcome to " + this.property.property_name + "...";
        },
        colours() {
            const primary = tinycolor(this.website.primary_colour);
            const secondary = tinycolor(this.website.secondary_colour);
            const text = tinycolor(this.website.text_colour);
            const background = tinycolor(this.website.background_colour);
            return {
                accentPrimary: primary,
                accentPrimaryAlt: this.lightenOrDarken(primary, 10),
                accentSecondary: secondary,
                accentSecondaryAlt: this.lightenOrDarken(secondary, 10),
                title: text,
                subtitle: this.lightenOrDarken(text, 3),
                text: this.lightenOrDarken(text, 7),
                background: background,
                backgroundAlt: tinycolor.mix(background, secondary, 7),
            };
        },
    },
    methods: {
        lightenOrDarken(baseColour, amount) {
            return baseColour.isLight() ? baseColour.clone().darken(amount) : baseColour.clone().lighten(amount);
        },
    },
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >
        <GeneratedSiteCarousel
            :images="coverImages"
            :autoplay="8000"
        />

        <PageSection
            :header="home_page.intro_section_header"
            :paragraph="home_page.intro_section_paragraph"
            :image="home_page.intro_section_image"
            :imageDescription="home_page.intro_section_image_description"
            :dividerArt="website.divider_art"
            :noDividerIfImage="true"
        >
            <div class="flex max-sm:flex-col justify-center gap-8 pt-4">
                <BookingButton
                    text="Make a booking"
                    :bookingLink="property.property_booking_link"
                />
                <LinkButton
                    text="Learn more"
                    :href="routes.about"
                />
            </div>
        </PageSection>

        <PageSection
            :header="welcomeHeader"
            :paragraph="home_page.welcome_section_paragraph"
            :image="home_page.welcome_section_image"
            :imageDescription="home_page.welcome_section_image_description"
            :flipped="true"
            :dividerArt="website.divider_art"
            :noDividerIfImage="true"
        >
            <div class="flex max-sm:flex-col justify-center gap-8 pt-4">
                <LinkButton
                    text="Our story"
                    :href="routes.about"
                />
                <LinkButton
                    text="Things to do in our area"
                    :href="routes.explore"
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
    font-family: v-bind('website.font_family'), Inter, sans-serif;
}
</style>
