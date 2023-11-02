<script setup>
import { Head } from '@inertiajs/vue3';
import ArrowButton from "@/Components/Buttons/ArrowButton.vue";
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import LoggedOutLayout from "@/Layouts/LoggedOutLayout.vue";

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
    <LoggedOutLayout>
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
    </LoggedOutLayout>
</template>

<style>
</style>
