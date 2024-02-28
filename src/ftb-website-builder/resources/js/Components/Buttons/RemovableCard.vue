<script setup>
import CrossIcon from "@/Components/Icons/CrossIcon.vue";

const props = defineProps({
    removeFunction: {
        type: Function,
        required: true,
    },
    params: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div class="wb-card gap-3 relative sm:pt-14">
        <div class="absolute top-0 right-0 p-4 flex justify-end w-full">
            <button
                v-on:click.prevent="removeFunction(...params)"
                class="wb-secondary-button sm:p-2 w-8 h-8"
            >
                <CrossIcon class="h-4"/>
            </button>
        </div>
        <slot/>
    </div>
</template>
