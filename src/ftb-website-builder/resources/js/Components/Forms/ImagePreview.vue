<script setup>
defineProps({
    modelValue: {
        type: [String, File],
        required: true,
    },
    fieldTitle: {
        type: String,
        required: true,
    }
});

const imagePreview = image => {
    return typeof image === 'string' ? image : URL.createObjectURL(image);
};
</script>

<template>
    <div
        v-if="modelValue !== null"
        class="space-y-2 wb-text p-2"
    >
        <p>
            Current {{ fieldTitle }}:
        </p>
        <img
            :src="imagePreview(modelValue)"
            :alt="'Currently selected ' + fieldTitle + '.'"
            class="max-h-96"
        />
    </div>
</template>
