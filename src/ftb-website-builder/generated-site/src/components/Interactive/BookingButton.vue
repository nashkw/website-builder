<script setup>
const props = defineProps({
    bookingLink: {
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
        class="gs-booking-button"
        :href="bookingLink"
    >
        {{ text }}
    </a>
</template>
