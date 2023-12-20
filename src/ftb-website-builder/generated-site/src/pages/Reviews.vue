<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import ReviewSection from "../components/Structural/ReviewSection.vue";

export default {
    name: "Reviews",
    components: {
        ReviewSection,
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        reviews_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.reviews_page.reviews_page_section_header ?? "Hear from our guests";
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
            :paragraph="reviews_page.reviews_page_section_paragraph"
            :image="reviews_page.reviews_page_section_image"
            :image-description="reviews_page.reviews_page_section_image_description"
        />

        <div class="flex flex-col xl:grid grid-cols-2 gap-6 px-8 xl:px-16">
            <ReviewSection
                v-for="review in reviews_page.reviews"
                :quote="review.review_quote"
                :reviewer="review.reviewer_name"
                :date="review.review_date"
                :rating="review.star_rating"
            />
        </div>
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>