<script setup>
import {router, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import PlusOrCrossButton from "@/Components/Buttons/PlusOrCrossButton.vue";
import AppHead from "@/Layout/AppHead.vue";

const props = defineProps({
    faq_page_section_header: String,
    faq_page_section_paragraph: String,
    faq_page_section_image: String,
    questions_and_answers: Array,
});

const form = useForm({
    faq_page_section_header: props.faq_page_section_header,
    faq_page_section_paragraph: props.faq_page_section_paragraph,
    faq_page_section_image: null,
    remove_faq_page_section_image: false,
    questions_and_answers: props.questions_and_answers,
    questions_and_answers_to_remove: [],
});

function addQuestionAndAnswer() {
    form.questions_and_answers.push({
        id: null,
        question_label: null,
        answer_paragraph: null,
    });
}

function removeQuestionAndAnswer(index) {
    if(form.questions_and_answers[index].id) {
        form.questions_and_answers_to_remove.push(form.questions_and_answers[index].id);
    }
    form.questions_and_answers.splice(index, 1);
}

router.on('success', (event) => {
    // reset Q&A fields when form is submitted successfully
    form.questions_and_answers = props.questions_and_answers;
    form.questions_and_answers_to_remove = [];
})
</script>

<template>
    <AppHead title="Edit your FAQ page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your FAQ page
        </h1>
        <form
            @submit.prevent="form.post(route('edit.faq.update'))"
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
                    :originalImage="props.faq_page_section_image"
                />
            </FormSection>

            <FormSection prompt="Add Q&As to your FAQ page. For best results try to keep your answers a similar length.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <div
                        v-for="(item, index) in form.questions_and_answers"
                        class="wb-card space-y-2"
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

                        <div class="flex w-full justify-end pt-2">
                            <PlusOrCrossButton
                                v-on:click="removeQuestionAndAnswer(index)"
                                text="Remove Q&A item"
                                isCross
                            />
                        </div>
                    </div>
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
