<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import GridSections from "../components/Structural/GridSections.vue";
import tinycolor from "tinycolor2";

export default {
    name: "FindUs",
    components: {
        GridSections,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        find_us_page: Object,
        page_flags: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.find_us_page.find_us_page_section_header ?? "How to find " + this.property.property_name;
        },
        formattedDirections() {
            let items = [];
            for (const direction of this.find_us_page.directions) {
                items.push({
                    header: direction.directions_label,
                    paragraph: direction.directions_paragraph,
                });
            }
            return items;
        },
        formattedAddress() {
            let address = this.property.property_address_line_1.split(' ').join('+');
            let lines = [
                this.property.property_address_line_2,
                this.property.property_address_area,
                this.property.property_address_country,
                this.property.property_address_postcode,
            ];
            for (const line of lines) {
                address = line ? address + ", " + line.split(' ').join('+') : address;
            }
            return address;
        },
        apiKey() {
            return import.meta.env.VITE_GOOGLE_MAPS_API_KEY;
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
        :page_flags="page_flags"
    >
        <PageSection
            :header="pageHeader"
            :paragraph="find_us_page.find_us_page_section_paragraph"
            :image="find_us_page.find_us_page_section_image"
            :imageDescription="find_us_page.find_us_page_section_image_description"
            :dividerArt="website.divider_art"
        />
        <GridSections :items="formattedDirections" />
        <div
            v-if="apiKey"
            class="px-8"
        >
            <iframe
                class="w-full"
                width="600"
                height="400"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                :src="'https://www.google.com/maps/embed/v1/place?key=' + apiKey + '&q=' + formattedAddress">
            </iframe>
        </div>
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
