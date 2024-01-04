<script setup>
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";

const props = defineProps({
    modelValue: {
        type: File,
    },
    fieldID: {
        type: String,
        required: true,
    },
    fieldTitle: {
        type: String,
        required: true,
    },
    currentImage: {
        type: [String, File, null],
        required: true,
    },
    errorMessage: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <FileInput
        :modelValue="modelValue"
        @update:modelValue="$emit('update:modelValue', $event)"
        :field-name="fieldID"
    />
    <InputError :message="errorMessage" />
    <ImagePreview
        :modelValue="currentImage"
        :field-title="fieldTitle"
    />
</template>

<style scoped>

</style>
