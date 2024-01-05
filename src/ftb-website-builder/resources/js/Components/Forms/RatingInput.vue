<script setup>
import StarRating from "vue-star-rating";
import Checkbox from "@/Components/Forms/Checkbox.vue";

const props = defineProps({
    modelValue: {
        type: [Number, null],
        required: true,
    },
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex flex-row w-full justify-between items-center h-10 ml-2 wb-text">
        <StarRating
            v-if="modelValue"
            :show-rating="false"
            :rating="modelValue"
            @update:rating="$emit('update:modelValue', $event)"
            :increment="0.5"
            :star-size="35"
            inactive-color="var(--colour-gradient-start)"
            active-color="var(--colour-accent-primary)"
        />
        <p v-else>
            No rating.
        </p>
        <label class="wb-secondary-button">
            <Checkbox
                name="Remove star rating"
                :checked="modelValue != null"
                @update:checked="$emit('update:modelValue', modelValue ? null : 1)"
                class="hidden"
            />
            <span v-if="modelValue">
                Remove star rating?
            </span>
            <span v-else>
                Add star rating?
            </span>
        </label>
    </div>
</template>

<style scoped>

</style>
