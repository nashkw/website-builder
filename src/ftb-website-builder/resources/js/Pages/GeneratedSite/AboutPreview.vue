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
        about_page: Object,
    },
    data() {
        return {
            property: {
                property_name: 'Test Hotel',
                property_address_line1: '100 Berkeley Street',
                property_address_line2: "2nd Floor",
                property_address_area: 'Glasgow',
                property_address_country: 'Scotland',
                property_address_postcode: 'G3 7HU',
                property_telephone: '+44 7123 456789',
                property_email: 'example.property@email.com',
                property_twitter_link: 'https://twitter.com/freetobook',
                property_youtube_link: 'https://www.youtube.com/user/freetobook',
                property_linkedin_link: 'https://www.linkedin.com/company/freetobook/',
                property_facebook_link: 'https://www.facebook.com/freetobook',
                property_instagram_link: 'https://www.instagram.com/freetobook/',
                property_tripadvisor_link: null,
            },
            routes: {
                home: route('preview'),
                rooms: route('preview.rooms'),
                about: route('preview.about'),
            },
        }
    },
}
</script>

<template>
    <Head title="About (preview)" />
    <About
        :property="property"
        :about_page="about_page"
        :routes="routes"
    />
</template>

<style scoped>

</style>
