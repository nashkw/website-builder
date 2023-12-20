<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";

export default {
    name: "Explore",
    components: {
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        explore_page: Object,
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
            :header="explore_page.explore_page_section_header"
            :paragraph="explore_page.explore_page_section_paragraph"
            :image="explore_page.explore_page_section_image"
            :image-description="explore_page.explore_page_section_image_description"
        />

        <PageSection
            v-for="(attraction, index) in explore_page.secondary_explore_sections"
            :header="attraction.attraction_header"
            :paragraph="attraction.attraction_paragraph"
            :image="attraction.attraction_image"
            :image-description="attraction.attraction_image_description"
            :flipped="index % 2 === 0"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
