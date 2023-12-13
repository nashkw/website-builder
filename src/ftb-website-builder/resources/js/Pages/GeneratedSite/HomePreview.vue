<script>
import Home from "../../../../generated-site/src/pages/Home.vue";
import '../../../../generated-site/src/assets/generatedSite.css'

export default {
    name: "HomePreview",
    components: {
        Home,
    },
    props: {
        propertyName: String,
        metaPageTitle: String,
        metaPageDescription: String,
        coverImagePrimary: String,
        coverImagePrimaryDescription: String,
        introSectionHeader: String,
        introSectionParagraph: String,
        introSectionImage: String,
        introSectionImageDescription: String,
        welcomeSectionHeader: String,
        welcomeSectionParagraph: String,
        welcomeSectionImage: String,
        welcomeSectionImageDescription: String,
        secondaryCoverImages: Array,
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
    <Home
        :property="property"
        :metaPageTitle="metaPageTitle"
        :metaPageDescription="metaPageDescription"
        :coverImagePrimary="coverImagePrimary"
        :coverImagePrimaryDescription="coverImagePrimaryDescription"
        :introSectionHeader="introSectionHeader"
        :introSectionParagraph="introSectionParagraph"
        :introSectionImage="introSectionImage"
        :introSectionImageDescription="introSectionImageDescription"
        :welcomeSectionHeader="welcomeSectionHeader"
        :welcomeSectionParagraph="welcomeSectionParagraph"
        :welcomeSectionImage="welcomeSectionImage"
        :welcomeSectionImageDescription="welcomeSectionImageDescription"
        :secondaryCoverImages="secondaryCoverImages"
        :routes="routes"
    />
</template>

<style scoped>

</style>
