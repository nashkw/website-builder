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
        secondaryCoverImages: Array,
        routes: Object,
    },
    computed: {
        coverImages() {
            return [
                {
                    secondaryCoverImage: this.coverImagePrimary,
                    secondaryCoverImageDescription: this.coverImagePrimaryDescription,
                },
                ...this.secondaryCoverImages
            ]
        },
        welcomeHeader() {
            return this.welcomeSectionHeader ?? "Welcome to " + this.property.propertyName + "..."
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
                    :src="slide.secondaryCoverImage"
                    :alt="slide.secondaryCoverImageDescription"
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
            :paragraph="welcomeSectionParagraph"
            :image="welcomeSectionImage"
            :image-description="welcomeSectionImageDescription"
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
