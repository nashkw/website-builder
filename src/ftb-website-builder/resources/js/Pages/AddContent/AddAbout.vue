<script setup>
import {useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import PlusOrCrossButton from "@/Components/Buttons/PlusOrCrossButton.vue";
import AppHead from "@/Layout/AppHead.vue";
import RemovableCard from "@/Components/Buttons/RemovableCard.vue";

const form = useForm({
    about_page_section_header: "",
    about_page_section_paragraph: "",
    about_page_section_image: null,
    remove_about_page_section_image: false,
    secondary_about_sections: [],
});

function addSection() {
    form.secondary_about_sections.push({
        secondary_about_section_header: null,
        secondary_about_section_paragraph: null,
        secondary_about_section_image: null,
    });
}

function removeSection(index) {
    form.secondary_about_sections.splice(index, 1);
}
</script>

<template>
    <AppHead title="Add an About page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Add an About page
        </h1>
        <form
            @submit.prevent="form.post(route('add.about.create'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header and a body paragraph telling customers all about your property. This can be however long you want, although if you write more than a few paragraphs you should consider splitting them into multiple sections.">
                <LabelledInputPair
                    v-model="form.about_page_section_header"
                    label="Page header"
                    placeholder="Our Story"
                    :errorMessage="form.errors.about_page_section_header"
                    fieldID="about_page_section_header"
                    required
                />
                <InputLabel
                    for="about_page_section_paragraph"
                    value="About paragraph"
                    class="sr-only"
                />
                <textarea
                    id="about_page_section_paragraph"
                    type="text"
                    v-model="form.about_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    required
                    autocomplete="about_page_section_paragraph"
                    placeholder="All about our property..."
                />
                <InputError :message="form.errors.about_page_section_paragraph" />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.about_page_section_image"
                    :errorMessage="form.errors.about_page_section_image"
                    fieldTitle="section image"
                    fieldID="about_page_section_image"
                    v-model:removeCurrentImage="form.remove_about_page_section_image"
                    :originalImage="null"
                />
            </FormSection>

            <FormSection prompt="Add more sections to your about page. Like the previous section, these will consist of a block of text optionally accompanied by an image and header.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <RemovableCard
                        v-for="(section, index) in form.secondary_about_sections"
                        :removeFunction="removeSection"
                        :params="[index]"
                    >
                        <LabelledInputPair
                            v-model="section.secondary_about_section_header"
                            label="Section header"
                            :errorMessage="form.errors['secondary_about_sections.' + index + '.secondary_about_section_header']"
                            :fieldID="'secondary_about_section_header_' + index"
                        />
                        <InputLabel
                            :for="'secondary_about_section_paragraph_' + index"
                            value="Section paragraph"
                            class="sr-only"
                        />
                        <textarea
                            :id="'secondary_about_section_paragraph_' + index"
                            type="text"
                            wrap="hard"
                            style="white-space: pre-wrap;"
                            v-model="section.secondary_about_section_paragraph"
                            class="wb-input-box h-40 s:h-20"
                            required
                            :autocomplete="'secondary_about_section_paragraph_' + index"
                            placeholder="More about our property..."
                        />
                        <InputError :message="form.errors['secondary_about_sections.' + index + '.secondary_about_section_paragraph']" />
                        <ImageInput
                            v-model="section.secondary_about_section_image"
                            :errorMessage="form.errors['secondary_about_sections.' + index + '.secondary_about_section_image']"
                            fieldTitle="section image"
                            :fieldID="'secondary_about_section_image_' + index"
                            v-model:removeCurrentImage="section.remove_secondary_about_section_image"
                            :originalImage="typeof(section.secondary_about_section_image) === String ? section.secondary_about_section_image : null"
                        />
                    </RemovableCard>
                    <InputError :message="form.errors.secondary_about_sections" />
                    <PlusOrCrossButton
                        v-on:click="addSection"
                        text="Add section"
                    />
                </div>
            </FormSection>

            <SaveButton
                :recentlySuccessful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
