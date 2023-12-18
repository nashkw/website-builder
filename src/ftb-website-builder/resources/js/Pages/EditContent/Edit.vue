<script setup>
import { Head } from '@inertiajs/vue3';
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import ClickableCard from "@/Components/Buttons/ClickableCard.vue";
</script>

<template>
    <Head title="Edit" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your website
        </h1>
        <div class="flex flex-col lg:grid grid-cols-2 gap-6">
            <ClickableCard
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
            <ClickableCard
                heading="Rooms"
                description="This page will let potential customers know what rooms you have available and help them decide which one they would prefer. The information needed for this page includes a name, description, and image for each category of room."
                button="Edit your rooms page"
                :href="route('edit.rooms')"
            />
            <ClickableCard
                heading="Reviews"
                description="This page will allow potential customers to view feedback from previous customers. The information needed for this page includes a name and quote for each review. Optionally, you can also attach the date of the review and a star rating."
                button="Edit your reviews page"
                :href="route('edit.reviews')"
            />
            <ClickableCard
                heading="About"
                description="This page is where you can tell customers all about your property. This could be anything from the history of your building to a picture of your team. The information needed for this page is whatever combination of text and images you need to tell your story."
                button="Edit your about page"
                :href="route('edit.about')"
            />
            <ClickableCard
                heading="Explore"
                description="This page lets potential customers browse things to do while staying at your property. The information needed for this page includes a description and image for each attraction you want to advertise to your customers."
                button="Edit your explore page"
                :href="route('edit.explore')"
            />
            <ClickableCard
                heading="Find Us"
                description="This page tells potential customers where your property is and how they can navigate to it. You could also tell them what to do when they arrive or about parking in the area. The information needed for this page includes directions to your property and a picture to help customers find their way."
                button="Edit your find us page"
                :href="route('edit.findus')"
            />
            <ClickableCard
                heading="FAQ"
                description="This page is where you can answer all the common questions you would expect from potential and current customers. The information needed for this page includes a list of questions and your answers to them."
                button="Edit your FAQ page"
                :href="route('edit.faq')"
            />
        </div>
    </LoggedInLayout>
</template>
