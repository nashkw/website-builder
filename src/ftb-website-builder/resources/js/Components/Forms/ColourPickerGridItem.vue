<script setup>
import InputLabel from "@/Components/Forms/InputLabel.vue";
import {ColorPicker} from "vue-accessible-color-picker";
import InputError from "@/Components/Forms/InputError.vue";

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    fieldID: {
        type: String,
        required: true,
    },
    errorMessage: {
        type: String,
        required: false,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex flex-col justify-center space-y-2 max-2xl:w-max ">
        <div class="flex flex-row justify-between mx-2">
            <InputLabel
                :for="fieldID"
                :value="label"
            />
            <div
                class="wb-color-patch"
                :style="{ backgroundColor: '#' + modelValue}"
            />
        </div>

        <ColorPicker
            class="wb-colour-picker"
            :color="'#' + modelValue"
            alpha-channel="hide"
            default-format="hex"
            :visible-formats="['hex']"
            :id="fieldID"
            @color-change="$emit('update:modelValue', $event.cssColor.replace('#', ''))"
        />
        <InputError :message="errorMessage" />
    </div>
</template>

<style scoped>

</style>
