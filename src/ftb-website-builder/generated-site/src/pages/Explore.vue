<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import tinycolor from "tinycolor2";

export default {
    name: "Explore",
    components: {
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        explore_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.explore_page.explore_page_section_header ?? "Things to do near " + this.property.property_name;
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
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >
        <PageSection
            :header="pageHeader"
            :paragraph="explore_page.explore_page_section_paragraph"
            :image="explore_page.explore_page_section_image"
            :imageDescription="explore_page.explore_page_section_image_description"
            :dividerArt="website.divider_art"
        />

        <PageSection
            v-for="(attraction, index) in explore_page.attractions"
            :header="attraction.attraction_header"
            :paragraph="attraction.attraction_paragraph"
            :image="attraction.attraction_image"
            :image-description="attraction.attraction_image_description"
            :flipped="index % 2 === 0"
            :subtitle="true"
        />
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
