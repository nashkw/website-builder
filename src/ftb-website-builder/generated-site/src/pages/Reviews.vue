<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import LinkButton from "../components/Interactive/LinkButton.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";

export default {
    name: "Reviews",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        reviews_page: Object,
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
            :header="reviews_page.reviews_page_section_header"
            :paragraph="reviews_page.reviews_page_section_paragraph"
            :image="reviews_page.reviews_page_section_image"
            :image-description="reviews_page.reviews_page_section_image_description"
        />

        <PageSection
            v-for="(review, index) in reviews_page.reviews"
            :header="review.reviewer_name"
            :paragraph="review.review_quote"
            :flipped="index % 2 === 0"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
