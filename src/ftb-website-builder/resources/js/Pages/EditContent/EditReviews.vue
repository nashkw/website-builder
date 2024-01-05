<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";

const props = defineProps({
    reviews_page_section_header: String,
    reviews_page_section_paragraph: String,
    reviews_page_section_image: String,
    reviews: Object,
});

const form = useForm({
    reviews_page_section_header: props.reviews_page_section_header,
    reviews_page_section_paragraph: props.reviews_page_section_paragraph,
    reviews_page_section_image: null,
    remove_reviews_page_section_image: false,
    reviews: props.reviews,
});
</script>

<template>
    <Head title="Edit your Reviews page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Reviews page
        </h1>
        <form
            @submit.prevent="form.post(route('edit.reviews.update'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header to sit at the top of your Reviews page. Optionally, you can write a body paragraph telling potential customers what guests think of your property and your approach to feedback. This can be however long you want, but the reviews themselves should be added separately.">
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
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.reviews_page_section_image"
                    :errorMessage="form.errors.reviews_page_section_image"
                    fieldTitle="section image"
                    fieldID="reviews_page_section_image"
                    v-model:removeCurrentImage="form.remove_reviews_page_section_image"
                    :originalImage="props.reviews_page_section_image"
                />
            </FormSection>

            <FormSection
                v-for="(review, index) in form.reviews"
                prompt="Add a review of your property that a previous guest has made."
            >
                <LabelledInputPair
                    v-model="review.review_quote"
                    showLabel
                    label="Review text"
                    labelClass="w-28"
                    :errorMessage="form.errors['reviews.' + index + '.review_quote']"
                    :fieldID="'review_quote_' + review.id"
                    required
                />
                <LabelledInputPair
                    v-model="review.reviewer_name"
                    showLabel
                    label="Reviewer name"
                    labelClass="w-28"
                    :errorMessage="form.errors['reviews.' + index + '.reviewer_name']"
                    :fieldID="'reviewer_name_' + review.id"
                    required
                />
                <LabelledInputPair
                    v-model="review.star_rating"
                    showLabel
                    label="Star rating"
                    labelClass="w-28"
                    placeholder="1-10"
                    :errorMessage="form.errors['reviews.' + index + '.star_rating']"
                    :fieldID="'star_rating_' + review.id"
                    inputType="rating"
                />
                <LabelledInputPair
                    v-model="review.review_date"
                    showLabel
                    label="Review date"
                    labelClass="w-28"
                    placeholder="1-10"
                    :errorMessage="form.errors['reviews.' + index + '.review_date']"
                    :fieldID="'review_date_' + review.id"
                    inputType="month"
                />
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
