<script setup>
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    text: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <a
        class="gs-header-button"
        :href="href"
    >
        {{ text }}
    </a>
</template>
