<script>
import About from "../../../../generated-site/src/pages/About.vue";
import '../../../../generated-site/src/assets/generatedSite.css'
import {Head} from "@inertiajs/vue3";

export default {
    name: "AboutPreview",
    components: {
        Head,
        About,
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
    data() {
        return {
            property: {
                propertyName: 'Test Hotel',
                propertyAddressLine1: '100 Berkeley Street',
                propertyAddressLine2: "2nd Floor",
                propertyAddressArea: 'Glasgow',
                propertyAddressCountry: 'Scotland',
                propertyAddressPostcode: 'G3 7HU',
                propertyTelephone: '+44 7123 456789',
                propertyEmail: 'example.property@email.com',
                propertyTwitterLink: 'https://twitter.com/freetobook',
                propertyYoutubeLink: 'https://www.youtube.com/user/freetobook',
                propertyLinkedinLink: 'https://www.linkedin.com/company/freetobook/',
                propertyFacebookLink: 'https://www.facebook.com/freetobook',
                propertyInstagramLink: 'https://www.instagram.com/freetobook/',
                propertyTripadvisorLink: null,
            },
            routes: {
                home: route('preview'),
                about: route('preview.about'),
            },
        }
    },
}
</script>

<template>
    <Head title="About preview" />
    <About
        :property="property"
        :metaPageTitle="metaPageTitle"
        :metaPageDescription="metaPageDescription"
        :aboutPageSectionHeader="aboutPageSectionHeader"
        :aboutPageSectionParagraph="aboutPageSectionParagraph"
        :aboutPageSectionImage="aboutPageSectionImage"
        :aboutPageSectionImageDescription="aboutPageSectionImageDescription"
        :secondaryAboutSections="secondaryAboutSections"
        :routes="routes"
    />
</template>

<style scoped>

</style>
