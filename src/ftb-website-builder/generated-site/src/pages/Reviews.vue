<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import ReviewSection from "../components/Structural/ReviewSection.vue";
import Divider from "../components/Structural/Divider.vue";
import tinycolor from "tinycolor2";

export default {
    name: "Reviews",
    components: {
        Divider,
        ReviewSection,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        reviews_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.reviews_page.reviews_page_section_header ?? "Hear from our guests";
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
            :paragraph="reviews_page.reviews_page_section_paragraph"
            :image="reviews_page.reviews_page_section_image"
            :imageDescription="reviews_page.reviews_page_section_image_description"
            :dividerArt="website.divider_art"
        />

        <div class="flex flex-col xl:grid grid-cols-2 gap-6 px-8 xl:px-16">
            <ReviewSection
                v-for="review in reviews_page.reviews"
                :quote="review.review_quote"
                :reviewer="review.reviewer_name"
                :date="review.review_date"
                :rating="review.star_rating"
            />
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
}
</style>
