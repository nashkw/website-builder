<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LeftArrowIcon from "../components/Icons/LeftArrowIcon.vue";
import RightArrowIcon from "../components/Icons/RightArrowIcon.vue";
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import LinkButton from "../components/Interactive/LinkButton.vue";
import BookingButton from "../components/Interactive/BookingButton.vue";

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
        property: Object,
        home_page: Object,
        routes: Object,
    },
    computed: {
        coverImages() {
            return [
                {
                    secondary_cover_image: this.home_page.cover_image_primary,
                    secondary_cover_image_description: this.home_page.cover_image_primary_description,
                },
                ...this.home_page.secondary_cover_images
            ]
        },
        welcomeHeader() {
            return this.home_page.welcome_section_header ?? "Welcome to " + this.property.property_name + "..."
        },
    },
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >

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
            :header="home_page.intro_section_header"
            :paragraph="home_page.intro_section_paragraph"
            :image="home_page.intro_section_image"
            :image-description="home_page.intro_section_image_description"
        >
            <div class="flex max-sm:flex-col justify-center gap-8 pt-4">
                <BookingButton
                    text="Make a booking"
                    bookingLink="/"
                />
                <LinkButton
                    text="Learn more"
                    :href="routes.about"
                />
            </div>
        </PageSection>

        <PageSection
            :header="welcomeHeader"
            :paragraph="home_page.welcome_section_paragraph"
            :image="home_page.welcome_section_image"
            :image-description="home_page.welcome_section_image_description"
            :flipped="true"
        >
            <div class="flex max-sm:flex-col justify-center gap-8 pt-4">
                <LinkButton
                    text="Our story"
                    :href="routes.about"
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
    height: 400px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
