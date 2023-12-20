<script setup>
const props = defineProps({
    quote: {
        type: String,
        required: true,
    },
    reviewer: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="gs-card space-y-6">
        <p class="">
            <em>"{{ quote }}"</em>
        </p>
        <h2 class="gs-text">
            {{ reviewer }}
        </h2>
    </div>
</template>
