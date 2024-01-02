<script setup>
import GeneratedSiteCarousel from "../Interactive/GeneratedSiteCarousel.vue";
import Divider from "./Divider.vue";

const props = defineProps({
    header: {
        type: String,
        required: false,
    },
    paragraph: {
        type: String,
        required: false,
    },
    image: {
        type: String,
        required: false,
    },
    imageDescription: {
        type: String,
        required: false,
    },
    images: {
        type: Array,
        required: false,
    },
    flipped: {
        type: Boolean,
        required: false,
    },
    subtitle: {
        type: Boolean,
        required: false,
    },
    dividerArt: {
        type: String,
        required: false,
    },
    noDividerIfImage: {
        type: Boolean,
        required: false,
    }
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
                class="text-center"
                :class="{'gs-subtitle': subtitle, 'gs-title': !subtitle}"
            >
                {{ header }}
            </h1>
            <p
                v-if="paragraph"
                v-for="(line, index) of paragraph.split('\\n')"
                :key="index"
                class="gs-text"
            >
                {{ line }}
            </p>
            <slot />
            <Divider
                v-if="dividerArt && !(noDividerIfImage && image)"
                :art="dividerArt"
                class="pt-16"
            />
        </div>
        <img
            v-if="image"
            :src="image"
            :alt="imageDescription"
            class="flex object-cover md:w-1/2 md:min-w-[50%] max-h-[800px]"
            :class="{'md:pr-5': flipped, 'md:pl-5': !flipped}"
        />
        <div
            v-else-if="images"
            class="flex md:w-1/2 md:min-w-[50%] max-h-[800px]"
            :class="{'md:pr-5': flipped, 'md:pl-5': !flipped}"
        >
            <GeneratedSiteCarousel :images="images" />
        </div>
    </div>
</template>

<style scoped>

</style>
