<script setup>
import { onMounted, ref } from 'vue';
import InputLabel from "@/Components/Forms/InputLabel.vue";

defineProps({
    modelValue: {
        type: [File, String],
    },
    fieldName: {
        type: String,
        required: true,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <InputLabel
        :for="fieldName"
        value="Choose file"
        class="sr-only"
    />
    <input
        :id="fieldName"
        type="file"
        @input="$emit('update:modelValue', $event.target.files[0])"
        :name="fieldName"
        class="wb-file-input"
        accept="image/*"
        ref="input"
    >
</template>
