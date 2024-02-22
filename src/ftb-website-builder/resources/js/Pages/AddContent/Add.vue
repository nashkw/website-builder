<script setup>
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import ClickableCard from "@/Components/Buttons/ClickableCard.vue";
import AppHead from "@/Layout/AppHead.vue";
import { computed } from 'vue'

const props = defineProps({
    page_flags: {
        type: Object,
        required: true,
    },
});

const noMissingPages = computed(() => {
    return props.page_flags.has_reviews_page
        && props.page_flags.has_about_page
        && props.page_flags.has_explore_page
        && props.page_flags.has_find_us_page
        && props.page_flags.has_faq_page;
})
</script>

<template>
    <AppHead title="Add pages" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Add more pages to your website
        </h1>
        <div
            v-if="!noMissingPages"
            class="flex flex-col lg:grid grid-cols-2 gap-6"
        >
            <ClickableCard
                v-if="!page_flags.has_reviews_page"
                heading="Reviews Page"
                description="This page will allow potential customers to view feedback from previous customers. The information needed for this page includes a name and quote for each review. Optionally, you can also attach the date of the review and a star rating."
                button="Add a reviews page"
                :href="route('add.reviews')"
                hubCard
            />
            <ClickableCard
                v-if="!page_flags.has_about_page"
                heading="About Page"
                description="This page is where you can tell customers all about your property. This could be anything from the history of your building to a picture of your team. The information needed for this page is whatever combination of text and images you need to tell your story."
                button="Add an about page"
                :href="route('add.about')"
                hubCard
            />
            <ClickableCard
                v-if="!page_flags.has_explore_page"
                heading="Explore Page"
                description="This page lets potential customers browse things to do while staying at your property. The information needed for this page includes a description and image for each attraction you want to advertise to your customers."
                button="Add an explore page"
                :href="route('add.explore')"
                hubCard
            />
            <ClickableCard
                v-if="!page_flags.has_find_us_page"
                heading="Find Us Page"
                description="This page tells potential customers where your property is and how they can navigate to it. You could also tell them what to do when they arrive or about parking in the area. The information needed for this page includes directions to your property and a picture to help customers find their way."
                button="Add a find us page"
                :href="route('add.findus')"
                hubCard
            />
            <ClickableCard
                v-if="!page_flags.has_faq_page"
                heading="FAQ Page"
                description="This page is where you can answer all the common questions you would expect from potential and current customers. The information needed for this page includes a list of questions and your answers to them."
                button="Add a FAQ page"
                :href="route('add.faq')"
                hubCard
            />
        </div>
        <div
            v-else
            class="wb-card wb-hub-empty-card space-y-6"
        >
            <p class="wb-subtitle">
                You have added all available pages to your website!
            </p>
            <p class="wb-text">
                To edit your pages please navigate to the
                <a
                    class="wb-text-link"
                    :href="route('edit')"
                >
                    Edit your website
                </a>
                section.
            </p>
        </div>
    </LoggedInLayout>
</template>
