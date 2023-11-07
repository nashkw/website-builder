<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import GearIcon from "@/Components/Icons/GearIcon.vue";
import PageIcon from "@/Components/Icons/PageIcon.vue";
import AccountIcon from "@/Components/Icons/AccountIcon.vue";
import ArrowIcon from "@/Components/Icons/ArrowIcon.vue";
import WebsiteBuilderHeader from "@/Components/Structural/WebsiteBuilderHeader.vue";
import WebsiteBuilderFooter from "@/Components/Structural/WebsiteBuilderFooter.vue";
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import ArrowButton from "@/Components/Buttons/ArrowButton.vue";

export default {
    name: "LoggedInLayout",
    components: {
        ArrowButton,
        SignInOutButton,
        WebsiteBuilderHeader,
        WebsiteBuilderFooter,
        ArrowIcon,
        AccountIcon,
        PageIcon,
        GearIcon,
        ApplicationLogo}
}
</script>

<template>
    <!-- toggle -->
    <WebsiteBuilderHeader class="lg:hidden"/>
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden">
        <div class="flex items-center py-4">
            <button
                type="button"
                class="text-gray-500 hover:text-gray-600"
                data-hs-overlay="#application-sidebar"
                aria-controls="application-sidebar"
                aria-label="Toggle navigation"
            >
                <span class="sr-only">
                    Toggle Navigation
                </span>
                <svg
                    class="w-5 h-5"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                    />
                </svg>
            </button>
        </div>
    </div>

    <!-- sidebar -->
    <div
        id="application-sidebar"
        class="wb-sidebar lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 space-y-4"
    >
        <ApplicationLogo />

        <nav
            class="hs-accordion-group flex flex-col w-full flex-wrap"
            data-hs-accordion-always-open
        >
            <ul class="space-y-1.5">
                <li>
                    <a
                        class="wb-sidebar-item"
                        href="/"
                    >
                        <GearIcon />
                        Edit your website
                    </a>
                </li>
                <li>
                    <a
                        class="wb-sidebar-item"
                        href="/"
                    >
                        <PageIcon />
                        Add more pages
                    </a>
                </li>
                <li>
                    <a
                        class="wb-sidebar-item"
                        href="/"
                    >
                        <AccountIcon />
                        Manage your account
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sticky top-[100vh] space-y-2">
            <ArrowButton
                href="/"
                text="View your website"
            />
            <SignInOutButton />
        </div>
    </div>

    <div class="flex w-full min-h-screen sm:p-6 md:p-8 lg:pl-72 gradient-bg">
        <div class="wb-page-container sm:rounded-lg">
            <slot />
        </div>
    </div>

</template>

<style scoped>

</style>
