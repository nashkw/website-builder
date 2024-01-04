<script setup>
defineProps({
    image: {
        type: [String, File, null],
        required: true,
    },
    fieldTitle: {
        type: String,
        required: true,
    }
});

const imagePreview = img => {
    return (typeof img === 'string') ? img : URL.createObjectURL(img);
};
</script>

<template>
    <div
        v-if="image !== null"
        class="space-y-2 wb-text px-2"
    >
        <p>
            Current {{ fieldTitle }}:
        </p>
        <img
            :src="imagePreview(image)"
            :alt="'Currently selected ' + fieldTitle + '.'"
            class="max-h-96"
        />
    </div>
</template>
