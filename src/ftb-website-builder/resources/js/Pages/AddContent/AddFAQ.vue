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
    faq_page_section_header: "",
    faq_page_section_paragraph: "",
    faq_page_section_image: null,
    remove_faq_page_section_image: false,
    questions_and_answers: [],
});

function addQuestionAndAnswer() {
    form.questions_and_answers.push({
        question_label: null,
        answer_paragraph: null,
    });
}

function removeQuestionAndAnswer(index) {
    form.questions_and_answers.splice(index, 1);
}
</script>

<template>
    <AppHead title="Add a FAQ page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Add a FAQ page
        </h1>
        <form
            @submit.prevent="form.post(route('add.faq.create'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header to sit at the top of your FAQ page. Optionally, you can write a body paragraph explaining your contact policies and where potential customers can go to answer their questions. This can be however long you want, but specific Q&As themselves should be added separately.">
                <LabelledInputPair
                    v-model="form.faq_page_section_header"
                    label="Page header"
                    placeholder="Hear from our guests"
                    :errorMessage="form.errors.faq_page_section_header"
                    fieldID="faq_page_section_header"
                    required
                />
                <InputLabel
                    for="faq_page_section_paragraph"
                    value="FAQ paragraph"
                    class="sr-only"
                />
                <textarea
                    id="faq_page_section_paragraph"
                    type="text"
                    v-model="form.faq_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    autocomplete="faq_page_section_paragraph"
                    placeholder="Your feedback is very important to us..."
                />
                <InputError :message="form.errors.faq_page_section_paragraph" />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.faq_page_section_image"
                    :errorMessage="form.errors.faq_page_section_image"
                    fieldTitle="section image"
                    fieldID="faq_page_section_image"
                    v-model:removeCurrentImage="form.remove_faq_page_section_image"
                    :originalImage="null"
                />
            </FormSection>

            <FormSection prompt="Add Q&As to your FAQ page. For best results try to keep your answers a similar length.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <RemovableCard
                        v-for="(item, index) in form.questions_and_answers"
                        :removeFunction="removeQuestionAndAnswer"
                        :params="[index]"
                    >
                        <LabelledInputPair
                            v-model="item.question_label"
                            label="Question label"
                            placeholder="Question"
                            :errorMessage="form.errors['questions_and_answers.' + index + '.question_label']"
                            :fieldID="'question_label_' + index"
                            required
                        />
                        <InputLabel
                            :for="'answer_paragraph_' + index"
                            value="Answer paragraph"
                            class="sr-only"
                        />
                        <textarea
                            :id="'answer_paragraph_' + index"
                            type="text"
                            v-model="item.answer_paragraph"
                            class="wb-input-box h-40 s:h-20"
                            required
                            :autocomplete="'answer_paragraph_' + index"
                            placeholder="Answer to the question..."
                        />
                        <InputError :message="form.errors['questions_and_answers.' + index + '.answer_paragraph']" />
                    </RemovableCard>
                    <InputError :message="form.errors.questions_and_answers" />
                    <PlusOrCrossButton
                        v-on:click="addQuestionAndAnswer"
                        text="Add Q&A item"
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
