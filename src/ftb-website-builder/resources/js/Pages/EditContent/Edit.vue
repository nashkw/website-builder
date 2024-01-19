<script setup>
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import ClickableCard from "@/Components/Buttons/ClickableCard.vue";
import AppHead from "@/Layout/AppHead.vue";
</script>

<template>
    <AppHead title="Edit" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your website
        </h1>
        <div class="flex flex-col lg:grid grid-cols-2 gap-6">
            <ClickableCard
                heading="Property Details"
                description="Click here to edit information about your property such as its name, logo, address, and all contact details associated with it. These include a phone number, an email address, and social media links. You can also edit your booking link, which is the URL customers will be directed to when they are ready to book."
                button="Edit your property details"
                :href="route('edit.property')"
                hubCard
            />
            <ClickableCard
                heading="Website Styling"
                description="Click here to edit your styling choices. These include which font to use, divider customisation, and colour scheme customisation. This involves selecting a primary colour, a secondary colour, a background colour, and a text colour."
                button="Edit your styling choices"
                :href="route('edit.website')"
                hubCard
            />
            <ClickableCard
                heading="Home Page"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
                hubCard
            />
            <ClickableCard
                heading="Rooms Page"
                description="This page will let potential customers know what rooms you have available and help them decide which one they would prefer. The information needed for this page includes a name, description, and image for each category of room."
                button="Edit your rooms page"
                :href="route('edit.rooms')"
                hubCard
            />
            <ClickableCard
                heading="Reviews Page"
                description="This page will allow potential customers to view feedback from previous customers. The information needed for this page includes a name and quote for each review. Optionally, you can also attach the date of the review and a star rating."
                button="Edit your reviews page"
                :href="route('edit.reviews')"
                hubCard
            />
            <ClickableCard
                heading="About Page"
                description="This page is where you can tell customers all about your property. This could be anything from the history of your building to a picture of your team. The information needed for this page is whatever combination of text and images you need to tell your story."
                button="Edit your about page"
                :href="route('edit.about')"
                hubCard
            />
            <ClickableCard
                heading="Explore Page"
                description="This page lets potential customers browse things to do while staying at your property. The information needed for this page includes a description and image for each attraction you want to advertise to your customers."
                button="Edit your explore page"
                :href="route('edit.explore')"
                hubCard
            />
            <ClickableCard
                heading="Find Us Page"
                description="This page tells potential customers where your property is and how they can navigate to it. You could also tell them what to do when they arrive or about parking in the area. The information needed for this page includes directions to your property and a picture to help customers find their way."
                button="Edit your find us page"
                :href="route('edit.findus')"
                hubCard
            />
            <ClickableCard
                heading="FAQ Page"
                description="This page is where you can answer all the common questions you would expect from potential and current customers. The information needed for this page includes a list of questions and your answers to them."
                button="Edit your FAQ page"
                :href="route('edit.faq')"
                hubCard
            />
        </div>
    </LoggedInLayout>
</template>
