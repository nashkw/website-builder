<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";

const props = defineProps({
    faq_page_section_header: String,
    faq_page_section_paragraph: String,
    faq_page_section_image: String,
});

const form = useForm({
    faq_page_section_header: props.faq_page_section_header,
    faq_page_section_paragraph: props.faq_page_section_paragraph,
    faq_page_section_image: null,
    remove_faq_page_section_image: false,
});

function submit() {
    form.post(route('edit.faq.update'))
}
</script>

<template>
    <Head title="Edit your FAQ page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your FAQ page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header to sit at the top of your FAQ page. Optionally, you can write a body paragraph explaining your contact policies and where potential customers can go to answer their questions. This can be however long you want, but specific Q&As themselves should be added separately.
                </p>
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

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <ImageInput
                    v-model="form.faq_page_section_image"
                    :errorMessage="form.errors.faq_page_section_image"
                    fieldTitle="section image"
                    fieldID="faq_page_section_image"
                    v-model:removeCurrentImage="form.remove_faq_page_section_image"
                    :originalImage="props.faq_page_section_image"
                />
            </div>

            <SaveButton
                :recently-successful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
