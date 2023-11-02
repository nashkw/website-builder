<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import WebsiteBuilderHeader from "@/Components/Structural/WebsiteBuilderHeader.vue";
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import WebsiteBuilderFooter from "@/Components/Structural/WebsiteBuilderFooter.vue";
import ArrowButton from "@/Components/Buttons/ArrowButton.vue";

export default {
    name: "LoggedOutLayout",
    components: {ArrowButton, WebsiteBuilderFooter, SignInOutButton, WebsiteBuilderHeader, ApplicationLogo}
}
</script>

<template>
    <div class="flex flex-col min-h-screen gradient-bg">
        <WebsiteBuilderHeader />

        <div class="flex-col flex-grow justify-center items-center gap-5 inline-flex">
            <slot />
        </div>

        <WebsiteBuilderFooter/>
    </div>
</template>

<style scoped>

</style>
