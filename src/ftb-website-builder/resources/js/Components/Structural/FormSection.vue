<script setup>
defineProps({
    prompt: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <div class="flex flex-col w-full gap-2">
        <p
            v-if="prompt"
            class="wb-subtitle p-2"
        >
            {{ prompt }}
        </p>
        <slot />
    </div>
</template>

<style scoped>

</style>
