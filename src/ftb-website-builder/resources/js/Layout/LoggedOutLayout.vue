<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import WebsiteBuilderFooter from "@/Layout/WebsiteBuilderFooter.vue";
import ArrowButton from "@/Components/Buttons/ArrowButton.vue";

export default {
    name: "LoggedOutLayout",
    components: {ArrowButton, WebsiteBuilderFooter, SignInOutButton, ApplicationLogo}
}
</script>

<template>
    <div class="flex flex-col min-h-screen gradient-bg">
        <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full wb-bg text-sm py-4">
            <nav
                aria-label="Global"
                class="w-full px-6 flex items-center justify-between"
            >
                <ApplicationLogo class="mx-6" />
                <SignInOutButton />
            </nav>
        </header>

        <div class="flex-col flex-grow justify-center items-center gap-5 inline-flex">
            <slot />
        </div>

        <WebsiteBuilderFooter/>
    </div>
</template>

<style scoped>

</style>
