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
import RemovableCard from "@/Components/Buttons/RemovableCard.vue";

const props = defineProps({
    reviews_page_section_header: String,
    reviews_page_section_paragraph: String,
    reviews_page_section_image: String,
    reviews: Array,
});

const form = useForm({
    reviews_page_section_header: props.reviews_page_section_header,
    reviews_page_section_paragraph: props.reviews_page_section_paragraph,
    reviews_page_section_image: null,
    remove_reviews_page_section_image: false,
    reviews: props.reviews,
    reviews_to_remove: [],
});

function addReview() {
    form.reviews.push({
        id: null,
        review_quote: null,
        reviewer_name: null,
        star_rating: null,
        review_date: null,
    });
}

function removeReview(index) {
    if(form.reviews[index].id) {
        form.reviews_to_remove.push(form.reviews[index].id);
    }
    form.reviews.splice(index, 1);
}

router.on('success', (event) => {
    // reset review fields when form is submitted successfully
    form.reviews = props.reviews;
    form.reviews_to_remove = [];
})
</script>

<template>
    <AppHead title="Edit your Reviews page" />
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

            <FormSection prompt="Add reviews of your property. Optionally, you can add star ratings and dates to your reviews.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <RemovableCard
                        v-for="(review, index) in form.reviews"
                        :removeFunction="removeReview"
                        :params="[index]"
                    >
                        <InputLabel
                            :for="'review_quote_' + index"
                            value="Review text"
                            class="sr-only"
                        />
                        <textarea
                            :id="'review_quote_' + index"
                            type="text"
                            v-model="review.review_quote"
                            class="wb-input-box h-24"
                            autocomplete="'review_quote_' + index"
                            placeholder="My review of this property is..."
                            required
                        />
                        <InputError :message="form.errors['reviews.' + index + '.review_quote']" />
                        <LabelledInputPair
                            v-model="review.reviewer_name"
                            showLabel
                            label="Reviewer name"
                            labelClass="w-28"
                            :errorMessage="form.errors['reviews.' + index + '.reviewer_name']"
                            :fieldID="'reviewer_name_' + index"
                            required
                        />
                        <LabelledInputPair
                            v-model="review.star_rating"
                            showLabel
                            label="Star rating"
                            labelClass="w-28"
                            placeholder="1-10"
                            :errorMessage="form.errors['reviews.' + index + '.star_rating']"
                            :fieldID="'star_rating_' + index"
                            inputType="rating"
                        />
                        <LabelledInputPair
                            v-model="review.review_date"
                            showLabel
                            label="Review date"
                            labelClass="w-28"
                            placeholder="2024-01"
                            :errorMessage="form.errors['reviews.' + index + '.review_date']"
                            :fieldID="'review_date_' + index"
                            inputType="month"
                        />
                    </RemovableCard>
                    <InputError :message="form.errors.reviews" />
                    <PlusOrCrossButton
                        v-on:click="addReview"
                        text="Add review"
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
