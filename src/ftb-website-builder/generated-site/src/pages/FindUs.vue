<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import GridSections from "../components/Structural/GridSections.vue";

export default {
    name: "FindUs",
    components: {
        GridSections,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        find_us_page: Object,
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
        }
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
            :paragraph="find_us_page.find_us_page_section_paragraph"
            :image="find_us_page.find_us_page_section_image"
            :image-description="find_us_page.find_us_page_section_image_description"
        />

        <GridSections :items="formattedDirections" />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
