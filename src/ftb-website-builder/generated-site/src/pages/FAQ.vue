<script>
import GeneratedSiteLayout from "../components/Structural/GeneratedSiteLayout.vue";
import PageSection from "../components/Structural/PageSection.vue";
import GridSections from "../components/Structural/GridSections.vue";

export default {
    name: "FAQ",
    components: {
        GridSections,
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
        questionAndAnswers() {
            let items = [];
            for (const questionAndAnswer of this.faq_page.question_and_answers) {
                items.push({
                    header: questionAndAnswer.question_label,
                    paragraph: questionAndAnswer.answer_paragraph,
                });
            }
            return items;
        },
    },
    methods: {
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

        <GridSections :items="questionAndAnswers" />
    </GeneratedSiteLayout>
</template>

<style scoped>

</style>
