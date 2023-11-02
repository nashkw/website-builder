<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="w-full">
        <p class="wb-text text-red-600">
            {{ message }}
        </p>
    </div>
</template>
