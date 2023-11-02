<script setup>
import ArrowIcon from "@/Components/Icons/ArrowIcon.vue";

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
        class="wb-primary-button"
        :href="href"
    >
        {{ text }}
        <ArrowIcon />
    </a>
</template>
