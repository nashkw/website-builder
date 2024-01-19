<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex flex-row items-center h-10 ml-2 wb-text gap-1">
        <p>
            https://
        </p>
        <input
            class="wb-input-box"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
        />
        <p>
            .ftb.sites
        </p>
    </div>
</template>

<style scoped>

</style>
