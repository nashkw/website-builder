<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";

export default {
    name: "FAQ",
    components: {
        PageSection,
        GeneratedSiteLayout,
    },
    props: {
        property: Object,
        faq_page: Object,
        routes: Object,
    },
    computed: {
        pageHeader() {
            return this.faq_page.faq_page_section_header ?? "Frequently asked questions";
        },
    },
}
</script>

<template>
    <GeneratedSiteLayout
        :property="property"
        :routes="routes"
    >
        <PageSection
            :header="pageHeader"
            :paragraph="faq_page.faq_page_section_paragraph"
            :image="faq_page.faq_page_section_image"
            :image-description="faq_page.faq_page_section_image_description"
        />

        <PageSection
            v-for="item in faq_page.question_and_answers"
            :header="item.question_label"
            :paragraph="item.answer_paragraph"
            :subtitle="true"
        />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
