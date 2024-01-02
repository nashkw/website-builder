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
        website: Object,
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

</style>
