<script setup>
const props = defineProps({
    header: {
        type: String,
        required: true,
    },
    paragraph: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    imageDescription: {
        type: String,
        required: true,
    },
    flipped: {
        type: Boolean,
        required: false,
    },
});
</script>

<template>
    <div
        class="flex flex-col md:flex-row w-full justify-center items-center px-8"
        :class="{'md:flex-row-reverse': flipped}"
    >
        <div class="flex flex-col p-10 space-y-4">
            <h1 class="gs-title">
                {{ header }}
            </h1>
            <p class="gs-text">
                {{ paragraph }}
            </p>
        </div>
        <img
            :src="image"
            :alt="imageDescription"
            class="flex object-cover md:w-1/2 md:min-w-[50%] max-h-[800px]"
        />
    </div>
</template>

<style scoped>

</style>
