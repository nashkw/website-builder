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
    <a
        :href="href"
    >
        <div class="wb-card space-y-4">
            <div class="space-y-2">
                <h2 class="wb-subtitle">
                    {{ heading }}
                </h2>
                <p class="wb-text">
                    {{ description }}
                </p>
            </div>
            <SecondaryButton
                :text="button"
                :href="href"
            />
        </div>
    </a>
</template>
