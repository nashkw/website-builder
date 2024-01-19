<script setup>
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
import RatingInput from "@/Components/Forms/RatingInput.vue";
import SubdomainInput from "@/Components/Forms/SubdomainInput.vue";

const props = defineProps({
    modelValue: {
        type: [String, Number, null],
        required: true,
    },
    fieldID: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        required: false,
    },
    errorMessage: {
        type: String,
        required: false,
    },
    showLabel: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        required: true
    },
    labelClass: {
        type: String,
        required: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    inputType: {
        type: String,
        required: false,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="wb-labelled-input-pair">
        <InputLabel
            :for="fieldID"
            :value="label + (showLabel ? ' :' : '')"
            :valueClass="showLabel ? 'wb-input-label ' + labelClass : ''"
            :class="showLabel ? '' : 'sr-only'"
        />
        <RatingInput
            v-if="inputType === 'rating'"
            :modelValue="modelValue"
            @update:modelValue="$emit('update:modelValue', $event)"
        />
        <SubdomainInput
            v-else-if="inputType === 'subdomain'"
            :modelValue="modelValue"
            @update:modelValue="$emit('update:modelValue', $event)"
        />
        <TextInput
            v-else
            :id="fieldID"
            :type="inputType ?? 'text'"
            :modelValue="props.modelValue"
            @update:modelValue="$emit('update:modelValue', $event)"
            :autocomplete="fieldID"
            :placeholder="placeholder ?? label"
            :required="required ?? null"
        />
    </div>
    <InputError :message="errorMessage" />
</template>

<style scoped>

</style>
