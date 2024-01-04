<script setup>
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import {computed} from "vue";

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
    originalImage: {
        type: [String, null],
        required: false,
    },
    currentImage: {
        type: [String, File, null],
        required: true,
    },
    removeCurrentImage: {
        type: Boolean,
        default: false,
    },
    errorMessage: {
        type: String,
        required: false,
    },
});

const isImage = computed(() => {
    return props.originalImage || props.modelValue;
})

defineEmits(['update:modelValue', 'update:removeCurrentImage']);
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
    <label
        v-if="isImage"
        class="wb-secondary-button ml-2"
    >
        <Checkbox
            name="Remove current image"
            :checked="removeCurrentImage"
            @update:checked="$emit('update:removeCurrentImage', $event)"
            class="hidden"
        />
        <span v-if="removeCurrentImage && (isImage)">
            No image selected. Use saved image?
        </span>
        <span v-else-if="isImage">
            Remove current image
        </span>
    </label>
</template>

<style scoped>

</style>
