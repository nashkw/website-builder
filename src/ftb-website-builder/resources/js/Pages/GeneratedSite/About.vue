<script>
import GeneratedSiteLayout from "@/Pages/GeneratedSite/Components/Structural/GeneratedSiteLayout.vue";
import PageSection from "@/Pages/GeneratedSite/Components/Structural/PageSection.vue";
import LinkButton from "@/Pages/GeneratedSite/Components/Interactive/LinkButton.vue";
import BookingButton from "@/Pages/GeneratedSite/Components/Interactive/BookingButton.vue";

export default {
    name: "About",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        metaPageTitle: String,
        metaPageDescription: String,
        aboutPageSectionHeader: String,
        aboutPageSectionParagraph: String,
        aboutPageSectionImage: String,
        aboutPageSectionImageDescription: String,
        secondaryAboutSections: Array,
    },
}
</script>

<template>
    <GeneratedSiteLayout>
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
