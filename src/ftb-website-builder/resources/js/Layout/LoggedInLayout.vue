<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import GearIcon from "@/Components/Icons/GearIcon.vue";
import PageIcon from "@/Components/Icons/PageIcon.vue";
import AccountIcon from "@/Components/Icons/AccountIcon.vue";
import ArrowIcon from "@/Components/Icons/ArrowIcon.vue";
import WebsiteBuilderFooter from "@/Components/Structural/WebsiteBuilderFooter.vue";
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import ArrowButton from "@/Components/Buttons/ArrowButton.vue";
import MenuIcon from "@/Components/Icons/MenuIcon.vue";

export default {
    name: "LoggedInLayout",
    components: {
        MenuIcon,
        ArrowButton,
        SignInOutButton,
        WebsiteBuilderFooter,
        ArrowIcon,
        AccountIcon,
        PageIcon,
        GearIcon,
        ApplicationLogo,
    }
}
</script>

<template>
    <!-- header -->
    <div class="sticky top-0 inset-x-0 z-20 wb-bg border-y px-4 sm:px-6 md:px-8 lg:hidden">
        <div class="flex items-center p-4 space-x-6">
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
                <MenuIcon />
            </button>
            <ol
                class="flex items-center whitespace-nowrap min-w-0 space-x-3"
                aria-label="Breadcrumb"
            >
                <ApplicationLogo />
            </ol>
        </div>
    </div>

    <!-- sidebar -->
    <div
        id="application-sidebar"
        class="wb-sidebar space-y-4 hs-overlay hs-overlay-open:translate-x-0 -translate-x-full hidden z-[60] lg:block lg:translate-x-0 lg:right-auto lg:bottom-0"
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
                        :href="route('edit')"
                    >
                        <GearIcon />
                        Edit your website
                    </a>
                </li>
                <li>
                    <a
                        class="wb-sidebar-item"
                        :href="route('add')"
                    >
                        <PageIcon />
                        Add more pages
                    </a>
                </li>
                <li>
                    <a
                        class="wb-sidebar-item"
                        :href="route('account')"
                    >
                        <AccountIcon />
                        Manage your account
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sticky top-[100vh] space-y-2">
            <ArrowButton
                :href="route('preview')"
                text="View website"
                :newTab="true"
            />
            <SignInOutButton />
        </div>
    </div>

    <div class="flex w-full min-h-screen sm:p-8 lg:pl-72 gradient-bg">
        <div class="wb-page-container w-full sm:rounded-lg space-y-6">
            <slot />
        </div>
    </div>

</template>

<style scoped>

</style>
