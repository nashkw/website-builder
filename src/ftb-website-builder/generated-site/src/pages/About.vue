<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";

export default {
    name: "About",
    components: {
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        website: Object,
        about_page: Object,
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
            :header="about_page.about_page_section_header"
            :paragraph="about_page.about_page_section_paragraph"
            :image="about_page.about_page_section_image"
            :imageDescription="about_page.about_page_section_image_description"
            :dividerArt="website.divider_art"
            :noDividerIfImage="true"
        />

        <PageSection
            v-for="(section, index) in about_page.secondary_about_sections"
            :header="section.secondary_about_section_header"
            :paragraph="section.secondary_about_section_paragraph"
            :image="section.secondary_about_section_image"
            :imageDescription="section.secondary_about_section_image_description"
            :flipped="index % 2 === 0"
            :dividerArt="website.divider_art"
            :noDividerIfImage="true"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
