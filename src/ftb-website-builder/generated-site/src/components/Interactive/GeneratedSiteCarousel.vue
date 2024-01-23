<script setup>
import 'vue3-carousel/dist/carousel.css'
import {Navigation, Pagination, Slide, Carousel} from "vue3-carousel";
import LeftArrowIcon from "../Icons/LeftArrowIcon.vue";
import RightArrowIcon from "../Icons/RightArrowIcon.vue";

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
    autoplay: {
        type: Number,
        default: 0,
    },
    wrap: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Carousel
        :autoplay="autoplay"
        :wrap-around="wrap"
    >
        <Slide
            v-for="slide in images"
            :key="slide"
        >
            <img
                :src="slide.image"
                :alt="slide.description"
                class="carousel__item"
            />
        </Slide>

        <template #addons>
            <Navigation>
                <template #next>
                    <RightArrowIcon class="gs-title" />
                </template>
                <template #prev>
                    <LeftArrowIcon class="gs-title" />
                </template>
            </Navigation>
        </template>
    </Carousel>
</template>

<style scoped>
.carousel__item {
    object-fit: cover;
    height: 400px;
    width: 100%;
}
</style>
