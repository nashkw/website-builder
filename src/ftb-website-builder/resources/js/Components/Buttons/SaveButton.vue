<script setup>
const props = defineProps({
    processing: {
        type: Boolean,
        required: true,
    },
    recentlySuccessful: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <div class="flex items-center gap-4">
        <button
            type="submit"
            :disabled="processing"
            class="wb-primary-button"
        >
            Save
        </button>
        <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
        >
            <p
                v-if="recentlySuccessful"
                class="wb-text"
            >
                Saved.
            </p>
        </Transition>
    </div>
</template>

<style scoped>

</style>
