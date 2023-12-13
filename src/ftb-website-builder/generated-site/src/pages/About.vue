<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import LinkButton from "../components/Interactive/LinkButton.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";

export default {
    name: "About",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        metaPageTitle: String,
        metaPageDescription: String,
        aboutPageSectionHeader: String,
        aboutPageSectionParagraph: String,
        aboutPageSectionImage: String,
        aboutPageSectionImageDescription: String,
        secondaryAboutSections: Array,
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
            :header="aboutPageSectionHeader"
            :paragraph="aboutPageSectionParagraph"
            :image="aboutPageSectionImage"
            :image-description="aboutPageSectionImageDescription"
        />

        <PageSection
            v-for="(section, index) in secondaryAboutSections"
            :header="section.secondaryAboutSectionHeader"
            :paragraph="section.secondaryAboutSectionParagraph"
            :image="section.secondaryAboutSectionImage"
            :image-description="section.secondaryAboutSectionImageDescription"
            :flipped="index % 2 === 0"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
