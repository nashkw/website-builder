<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LeftArrowIcon from "@/Pages/GeneratedSite/Components/Icons/LeftArrowIcon.vue";
import RightArrowIcon from "@/Pages/GeneratedSite/Components/Icons/RightArrowIcon.vue";
import GeneratedSiteLayout from "@/Pages/GeneratedSite/Components/Structural/GeneratedSiteLayout.vue";
import PageSection from "@/Pages/GeneratedSite/Components/Structural/PageSection.vue";
import LinkButton from "@/Pages/GeneratedSite/Components/Interactive/LinkButton.vue";
import BookingButton from "@/Pages/GeneratedSite/Components/Interactive/BookingButton.vue";

import primary_cover_image from './Data/primary_cover_image.jpg';
import secondary_cover_image_1 from './Data/secondary_cover_image_1.jpg';
import secondary_cover_image_2 from './Data/secondary_cover_image_2.jpg';
import intro_image from './Data/introduction_section_image.jpg';
import welcome_image from './Data/welcome_section_image.jpg';

export default {
    name: "Home",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
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
            property_name: "Test Hotel",
            cover_image_primary: primary_cover_image,
            cover_image_primary_description: "cover_image_primary_description",
            secondary_cover_images: [
                {
                    secondary_cover_image: secondary_cover_image_1,
                    secondary_cover_image_description: "secondary_cover_image_1_description",
                },
                {
                    secondary_cover_image: secondary_cover_image_2,
                    secondary_cover_image_description: "secondary_cover_image_2_description",
                },
            ],
            intro_section_header: "Glasgow's finest",
            intro_section_paragraph: "Discover luxury at its peak with stylish accommodations, top-notch amenities, and personalized service. Indulge in gourmet dining, spa retreats, and unparalleled hospitality. Book now for an unforgettable stay.",
            intro_section_image: intro_image,
            intro_section_image_description: "intro_image_description",
            welcome_section_header: "Welcome to Test Hotel...",
            welcome_section_paragraph: "Welcome to a world of unparalleled hospitality and comfort! We are delighted to have you as our guest. From the moment you step through our doors, expect an experience tailored to exceed your expectations. Our dedicated team is committed to ensuring your stay is nothing short of extraordinary. Whether you are here for business or leisure, we invite you to relax, indulge, and make yourself at home. Your journey with us begins now, and we are honored to be a part of it.",
            welcome_section_image: welcome_image,
            welcome_section_image_description: "welcome_image_description",
        }
    },
    computed: {
        coverImages() {
            return [
                {
                    secondary_cover_image: this.cover_image_primary,
                    secondary_cover_image_description: this.cover_image_primary_description,
                },
                ...this.secondary_cover_images
            ]
        },
        welcomeHeader() {
            return this.welcome_section_header ?? "Welcome to " + this.property_name + "..."
        },
    },
}
</script>

<template>
    <GeneratedSiteLayout>

        <Carousel
            :autoplay="8000"
            :wrap-around="true"
        >
            <Slide
                v-for="slide in coverImages"
                :key="slide"
            >
                <img
                    :src="slide.secondary_cover_image"
                    :alt="slide.secondary_cover_image_description"
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

        <PageSection
            :header="intro_section_header"
            :paragraph="intro_section_paragraph"
            :image="intro_section_image"
            :image-description="intro_section_image_description"
        >
            <div class="flex justify-center gap-8 pt-4">
                <BookingButton
                    text="Make a booking"
                    bookingLink="/"
                />
                <LinkButton
                    text="Learn more"
                    :href="route('preview.about')"
                />
            </div>
        </PageSection>

        <PageSection
            :header="welcomeHeader"
            :paragraph="welcome_section_paragraph"
            :image="welcome_section_image"
            :image-description="welcome_section_image_description"
            :flipped="true"
        >
            <div class="flex justify-center gap-8 pt-4">
                <LinkButton
                    text="Our story"
                    :href="route('preview.about')"
                />
                <LinkButton
                    text="Things to do in our area"
                    href=""
                />
            </div>
        </PageSection>
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
