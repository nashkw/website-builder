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
    props: {
        propertyName: String,
        metaPageTitle: String,
        metaPageDescription: String,
        coverImagePrimary: String,
        coverImagePrimaryDescription: String,
        introSectionHeader: String,
        introSectionParagraph: String,
        introSectionImage: String,
        introSectionImageDescription: String,
        welcomeSectionHeader: String,
        welcomeSectionParagraph: String,
        welcomeSectionImage: String,
        welcomeSectionImageDescription: String,
    },
    data() {
        return {
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
        }
    },
    computed: {
        coverImages() {
            return [
                {
                    secondary_cover_image: this.coverImagePrimary,
                    secondary_cover_image_description: this.coverImagePrimaryDescription,
                },
                ...this.secondary_cover_images
            ]
        },
        welcomeHeader() {
            return this.welcomeSectionHeader ?? "Welcome to " + this.propertyName + "..."
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
            :header="introSectionHeader"
            :paragraph="introSectionParagraph"
            :image="introSectionImage"
            :image-description="introSectionImageDescription"
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
            :paragraph="welcomeSectionParagraph"
            :image="welcomeSectionImage"
            :image-description="welcomeSectionImageDescription"
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
