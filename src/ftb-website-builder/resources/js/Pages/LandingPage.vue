<script setup>
import { Head, Link } from '@inertiajs/vue3';
import WebsiteBuilderFooter from "@/Components/Structural/WebsiteBuilderFooter.vue";
import WebsiteBuilderHeader from "@/Components/Structural/WebsiteBuilderHeader.vue";
import ArrowButton from "@/Components/ArrowButton.vue";
import SignInOutButton from "@/Components/SignInOutButton.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Website Builder" />
    <div class="flex flex-col min-h-screen bg-gradient-to-br from-purple-200 via-rose-100 to-orange-100">
        <WebsiteBuilderHeader />

        <div class="flex-col flex-grow justify-center items-center gap-5 inline-flex">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
                <div class="max-w-2xl text-center mx-auto">
                    <div class="mt-5 max-w-2xl">
                        <h1 class="block font-semibold text-gray-800 text-4xl md:text-5xl lg:text-6xl">
                            Website Builder
                        </h1>
                    </div>
                    <div class="mt-5 max-w-3xl">
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            a tailored experience for rental properties
                        </p>
                    </div>

                    <div
                        v-if="$page.props.auth.user"
                        class="mt-8 grid gap-3 w-full sm:inline-flex sm:justify-center"
                    >
                        <ArrowButton href="dashboard" text="Continue your journey" />
                    </div>
                    <div
                        v-else
                        class="mt-8 grid gap-3 w-full sm:inline-flex sm:justify-center"
                    >
                        <ArrowButton href="register" text="Get started" />
                        <SignInOutButton />
                    </div>
                </div>
            </div>
        </div>

        <WebsiteBuilderFooter/>
    </div>
</template>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

.bg-gradient {
    background: var(--gradient-cover, linear-gradient(138deg, #F0DCFF -7.15%, #FFECE4 63.86%, rgba(255, 251, 217, 0.00) 118.99%));
}
</style>
