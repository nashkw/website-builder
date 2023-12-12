<script setup>
const props = defineProps({
    header: {
        type: String,
        required: false,
    },
    paragraph: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: false,
    },
    imageDescription: {
        type: String,
        required: false,
    },
    flipped: {
        type: Boolean,
        required: false,
    },
});
</script>

<template>
    <div
        class="flex flex-col md:flex-row w-full justify-center items-center px-8 gap-8"
        :class="{'md:flex-row-reverse': flipped, 'px-48': !image}"
    >
        <div class="flex flex-col p-10 space-y-8">
            <h1
                v-if="header"
                class="gs-title"
            >
                {{ header }}
            </h1>
            <p class="gs-text">
                {{ paragraph }}
            </p>
            <slot />
        </div>
        <img
            v-if="image"
            :src="image"
            :alt="imageDescription"
            class="flex object-cover md:w-1/2 md:min-w-[50%] max-h-[800px]"
            :class="{'md:pr-5': flipped, 'md:pl-5': !flipped}"
        />
    </div>
</template>

<style scoped>

</style>
