<script>
import {useStore} from "@/stores/store.js";
import {mapState} from "pinia";
import Home from "@/pages/Home.vue";
import GeneratedSiteLayout from "@/components/Structural/GeneratedSiteLayout.vue";

export default {
    name: "HomeView",
    components: {
        GeneratedSiteLayout,
        Home,
    },
    computed: {
        ...mapState(useStore, [
            'home_page',
            'property',
            'routes',
        ]),
        formattedSecondaryCoverImages() {
            let formattedData = [];
            for (const item of this.home_page.secondaryCoverImages) {
                formattedData.push({
                    secondaryCoverImage: this.formatImagePath(item.secondaryCoverImage),
                    secondaryCoverImageDescription: item.secondaryCoverImageDescription,
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
    <Home
        :property="property"
        :metaPageTitle="home_page.metaPageTitle"
        :metaPageDescription="home_page.metaPageDescription"
        :coverImagePrimary="formatImagePath(home_page.coverImagePrimary)"
        :coverImagePrimaryDescription="home_page.coverImagePrimaryDescription"
        :introSectionHeader="home_page.introSectionHeader"
        :introSectionParagraph="home_page.introSectionParagraph"
        :introSectionImage="formatImagePath(home_page.introSectionImage)"
        :introSectionImageDescription="home_page.introSectionImageDescription"
        :welcomeSectionHeader="home_page.welcomeSectionHeader"
        :welcomeSectionParagraph="home_page.welcomeSectionParagraph"
        :welcomeSectionImage="formatImagePath(home_page.welcomeSectionImage)"
        :welcomeSectionImageDescription="home_page.welcomeSectionImageDescription"
        :secondaryCoverImages="formattedSecondaryCoverImages"
        :routes="routes"
    />
</template>

<style scoped>

</style>
