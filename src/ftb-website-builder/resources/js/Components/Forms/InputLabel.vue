<script setup>
defineProps({
    value: {
        type: String,
        required: false,
    },
    valueClass: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <label class="block wb-subtitle">
        <span
            v-if="value"
            :class="valueClass"
        >
            {{ value }}
        </span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>
