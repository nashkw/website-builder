<script>
import GeneratedSiteLayout from "@/Pages/GeneratedSite/Components/GeneratedSiteLayout.vue";
import primary_cover_image from './Data/primary_cover_image.jpg';
import secondary_cover_image_1 from './Data/secondary_cover_image_1.jpg';
import secondary_cover_image_2 from './Data/secondary_cover_image_2.jpg';
import LeftArrowIcon from "@/Pages/GeneratedSite/Components/Icons/LeftArrowIcon.vue";
import RightArrowIcon from "@/Pages/GeneratedSite/Components/Icons/RightArrowIcon.vue";
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

export default {
    name: "Home",
    components: {
        RightArrowIcon,
        LeftArrowIcon,
        GeneratedSiteLayout,
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        return {
            cover_images: [
                {
                    image: primary_cover_image,
                    description: "cover_image_primary_description",
                },
                {
                    image: secondary_cover_image_1,
                    description: "secondary_cover_image_1_description",
                },
                {
                    image: secondary_cover_image_2,
                    description: "secondary_cover_image_2_description",
                },
            ],
        }
    }
}
</script>

<template>
    <GeneratedSiteLayout>

        <Carousel
            :autoplay="8000"
            :wrap-around="true"
        >
            <Slide v-for="slide in cover_images" :key="slide">
                <img
                    :src="slide.image"
                    :alt="slide.description"
                    class="carousel__item"
                />
            </Slide>

            <template #addons>
                <Navigation>
                    <template #next>
                        <RightArrowIcon />
                    </template>
                    <template #prev>
                        <LeftArrowIcon />
                    </template>
                </Navigation>
                <Pagination />
            </template>
        </Carousel>

        <div class="flex flex-col w-full justify-center items-center">
            This is the home page.
        </div>
    </GeneratedSiteLayout>
</template>

<style scoped>
.carousel__item {
    object-fit: cover;
    min-height: 300px;
    max-height: 400px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
