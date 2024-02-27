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
    newTab: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>
    <a
        class="wb-primary-button"
        :href="href"
        :target="newTab ? '_blank' : ''"
    >
        {{ text }}
        <ArrowIcon />
    </a>
</template>
