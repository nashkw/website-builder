<script setup>
import PlusIcon from "@/Components/Icons/PlusIcon.vue";
import CrossIcon from "@/Components/Icons/CrossIcon.vue";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    isCross: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>
    <button
        type="button"
        class="wb-primary-button"
    >
        <CrossIcon
            v-if="isCross"
            class="h-3 w-3"
        />
        <PlusIcon
            v-else
            class="h-3 w-3"
        />
        {{ text }}
    </button>
</template>

<style scoped>

</style>
