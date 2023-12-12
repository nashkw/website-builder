<script setup>
import RightArrowIcon from "@/Pages/GeneratedSite/Components/Icons/RightArrowIcon.vue";

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
        class="gs-link-button"
        :href="href"
    >
        {{ text }}
        <RightArrowIcon />
    </a>
</template>
