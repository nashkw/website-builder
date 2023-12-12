<script>
import GeneratedSiteLayout from "@/Pages/GeneratedSite/Components/Structural/GeneratedSiteLayout.vue";
import PageSection from "@/Pages/GeneratedSite/Components/Structural/PageSection.vue";
import LinkButton from "@/Pages/GeneratedSite/Components/Interactive/LinkButton.vue";
import BookingButton from "@/Pages/GeneratedSite/Components/Interactive/BookingButton.vue";

import about_image from './Data/about_section_image.jpg';
import secondary_about_image_1 from './Data/secondary_about_image_1.jpg';
import secondary_about_image_2 from './Data/secondary_about_image_2.jpg';

export default {
    name: "About",
    components: {
        BookingButton,
        LinkButton,
        PageSection,
        GeneratedSiteLayout,
    },
    data() {
        return {
            property_name: "Test Hotel",
            about_page_section_header: null,
            about_page_section_paragraph: "In the heart of the city, our hotel began as a vision—a dream to create a space where luxury and hospitality seamlessly intertwined. Guided by this passion, we embarked on a journey of meticulous planning and thoughtful design. From the initial sketches to the final touches, every detail was crafted to evoke a sense of comfort and sophistication, setting the stage for an exceptional stay.",
            about_page_section_image: about_image,
            about_page_section_image_description: "about_image_description",
            secondary_about_sections: [
                {
                    secondary_about_section_header: null,
                    secondary_about_section_paragraph: "As the doors opened, our story unfolded through the experiences of our guests. They discovered the warmth of our attentive staff, the stylish allure of our accommodations, and the seamless fusion of modern amenities with timeless charm. Positive reviews echoed the success of our endeavor, reinforcing our commitment to delivering an unparalleled escape for each visitor.",
                    secondary_about_section_image: secondary_about_image_1,
                    secondary_about_section_image_description: "secondary_about_image_1_description",
                },
                {
                    secondary_about_section_header: null,
                    secondary_about_section_paragraph: "Today, our hotel stands as a testament to the dedication that birthed its existence. It is a living story, where every check-in adds a new chapter. Whether guests are here for business or leisure, the narrative continues to evolve, creating a legacy of cherished moments and satisfied smiles. Our story is ongoing, and we invite you to be a part of it—your chapter awaits at our doors.",
                    secondary_about_section_image: secondary_about_image_2,
                    secondary_about_section_image_description: "secondary_about_image_2_description",
                },
            ],
        }
    },
    computed: {
        pageHeader() {
            return this.about_page_section_header ?? "About " + this.property_name
        },
    }
}
</script>

<template>
    <GeneratedSiteLayout>
        <PageSection
            :header="pageHeader"
            :paragraph="about_page_section_paragraph"
            :image="about_page_section_image"
            :image-description="about_page_section_image_description"
        />

        <PageSection
            v-for="(section, index) in secondary_about_sections"
            :header="section.secondary_about_section_header"
            :paragraph="section.secondary_about_section_paragraph"
            :image="section.secondary_about_section_image"
            :image-description="section.secondary_about_section_image_description"
            :flipped="index % 2 === 0"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
