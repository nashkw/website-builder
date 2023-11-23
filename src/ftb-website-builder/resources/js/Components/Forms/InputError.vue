<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="w-full">
        <p class="wb-text-error">
            {{ message }}
        </p>
    </div>
</template>
