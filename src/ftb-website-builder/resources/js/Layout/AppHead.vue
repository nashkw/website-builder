<script setup>
import { Head } from '@inertiajs/vue3'

const appName = import.meta.env.VITE_APP_NAME || 'Website Builder';

defineProps({
    title: String,
    required: false,
});
</script>

<template>
    <Head :title="title ? `${title} - ${appName}` : appName">
        <slot />
    </Head>
</template>
