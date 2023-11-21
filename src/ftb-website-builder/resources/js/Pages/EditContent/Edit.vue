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
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
            <ClickableCard
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
            <ClickableCard
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
            <ClickableCard
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
            <ClickableCard
                heading="Home"
                description="This is the landing page of your website, intended to help potential customers quickly understand what you're all about. The information needed for this page includes your introduction paragraph, your welcome paragraph, and your cover images."
                button="Edit your home page"
                :href="route('edit.home')"
            />
        </div>
    </LoggedInLayout>
</template>
