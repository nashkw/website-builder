<script setup>
import { Head } from '@inertiajs/vue3'

const appName = import.meta.env.VITE_APP_NAME || 'Website Builder';

const props = defineProps({
    title: {
        type: String,
        required: false,
    },
    favicon: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <Head :title="title ? `${title} - ${appName}` : appName">
        <link
            v-if="favicon"
            rel="icon"
            type="image/x-icon"
            :href="favicon"
        />
        <slot />
    </Head>
</template>
