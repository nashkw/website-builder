<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";

const props = defineProps({
    reviews_page_section_header: String,
    reviews_page_section_paragraph: String,
    reviews_page_section_image: String,
});

const form = useForm({
    reviews_page_section_header: props.reviews_page_section_header,
    reviews_page_section_paragraph: props.reviews_page_section_paragraph,
    reviews_page_section_image: null,
    remove_reviews_page_section_image: false,
});

const reviews_page_section_image = computed(() => {
    return form.remove_reviews_page_section_image ? null : form.reviews_page_section_image ?? props.reviews_page_section_image
})

function submit() {
    form.post(route('edit.reviews.update'))
}
</script>

<template>
    <Head title="Edit your Reviews page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Reviews page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header to sit at the top of your Reviews page. Optionally, you can write a body paragraph telling potential customers what guests think of your property and your approach to feedback. This can be however long you want, but the reviews themselves should be added separately.
                </p>
                <LabelledInputPair
                    v-model="form.reviews_page_section_header"
                    label="Page header"
                    placeholder="Hear from our guests"
                    :errorMessage="form.errors.reviews_page_section_header"
                    fieldID="reviews_page_section_header"
                    required
                />

                <InputLabel
                    for="reviews_page_section_paragraph"
                    value="Reviews paragraph"
                    class="sr-only"
                />
                <textarea
                    id="reviews_page_section_paragraph"
                    type="text"
                    v-model="form.reviews_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    autocomplete="reviews_page_section_paragraph"
                    placeholder="Your feedback is very important to us..."
                />
                <InputError :message="form.errors.reviews_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <ImageInput
                    v-model="form.reviews_page_section_image"
                    :currentImage="reviews_page_section_image"
                    :errorMessage="form.errors.reviews_page_section_image"
                    fieldTitle="section image"
                    fieldID="reviews_page_section_image"
                    v-model:removeCurrentImage="form.remove_reviews_page_section_image"
                    :originalImage="props.reviews_page_section_image"
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
