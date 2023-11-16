<script setup>

import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    heading: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    button: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="wb-card">
        <a
            :href="href"
        >
            <h2 class="wb-subtitle">
                {{ heading }}
            </h2>
            <p class="wb-text">
                {{ description }}
            </p>
            <SecondaryButton
                :text="button"
                :href="href"
            />
        </a>
    </div>
</template>
