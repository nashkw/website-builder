<script>
import {mapState} from "pinia";
import {useStore} from "@/stores/store.js";
import About from "@/pages/About.vue";
import Home from "@/pages/Home.vue";

export default {
    name: "AboutView",
    components: {
        Home,
        About,
    },
    computed: {
        ...mapState(useStore, [
            'about_page',
            'property',
            'routes',
        ]),
        formattedSecondaryAboutSections() {
            let formattedData = [];
            for (const item of this.about_page.secondaryAboutSections) {
                formattedData.push({
                    secondaryAboutSectionHeader: item.secondaryAboutSectionHeader,
                    secondaryAboutSectionParagraph: item.secondaryAboutSectionParagraph,
                    secondaryAboutSectionImage: this.formatImagePath(item.secondaryAboutSectionImage),
                    secondaryAboutSectionImageDescription: item.secondaryAboutSectionImageDescription,
                });
            }
            return formattedData;
        },
    },
    methods: {
        formatImagePath(path) {
            return '/src/data/' + path;
        },
    },
}
</script>

<template>
    <About
        :property="property"
        :metaPageTitle="about_page.metaPageTitle"
        :metaPageDescription="about_page.metaPageDescription"
        :aboutPageSectionHeader="about_page.aboutPageSectionHeader"
        :aboutPageSectionParagraph="about_page.aboutPageSectionParagraph"
        :aboutPageSectionImage="formatImagePath(about_page.aboutPageSectionImage)"
        :aboutPageSectionImageDescription="about_page.aboutPageSectionImageDescription"
        :secondaryAboutSections="formattedSecondaryAboutSections"
        :routes="routes"
    />
</template>

<style scoped>

</style>
