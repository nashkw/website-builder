<script setup>
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import AppHead from "@/Layout/AppHead.vue";
import ClickableCard from "@/Components/Buttons/ClickableCard.vue";
</script>

<template>
    <AppHead title="Add pages" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Add more pages to your website
        </h1>
        <div class="flex flex-col lg:grid grid-cols-2 gap-6">
            <ClickableCard
                heading="Reviews Page"
                description="This page will allow potential customers to view feedback from previous customers. The information needed for this page includes a name and quote for each review. Optionally, you can also attach the date of the review and a star rating."
                button="Add a reviews page"
                :href="route('add.reviews')"
                hubCard
            />
            <ClickableCard
                heading="About Page"
                description="This page is where you can tell customers all about your property. This could be anything from the history of your building to a picture of your team. The information needed for this page is whatever combination of text and images you need to tell your story."
                button="Add an about page"
                :href="route('add.about')"
                hubCard
            />
            <ClickableCard
                heading="Explore Page"
                description="This page lets potential customers browse things to do while staying at your property. The information needed for this page includes a description and image for each attraction you want to advertise to your customers."
                button="Add an explore page"
                :href="route('add.explore')"
                hubCard
            />
            <ClickableCard
                heading="Find Us Page"
                description="This page tells potential customers where your property is and how they can navigate to it. You could also tell them what to do when they arrive or about parking in the area. The information needed for this page includes directions to your property and a picture to help customers find their way."
                button="Add a find us page"
                :href="route('add.findus')"
                hubCard
            />
            <ClickableCard
                heading="FAQ Page"
                description="This page is where you can answer all the common questions you would expect from potential and current customers. The information needed for this page includes a list of questions and your answers to them."
                button="Add a FAQ page"
                :href="route('add.faq')"
                hubCard
            />
        </div>
    </LoggedInLayout>
</template>
