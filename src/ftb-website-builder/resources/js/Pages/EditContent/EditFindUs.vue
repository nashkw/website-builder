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
    find_us_page_section_header: String,
    find_us_page_section_paragraph: String,
    find_us_page_section_image: String,
});

const form = useForm({
    find_us_page_section_header: props.find_us_page_section_header,
    find_us_page_section_paragraph: props.find_us_page_section_paragraph,
    find_us_page_section_image: null,
    remove_find_us_page_section_image: false,
});

const find_us_page_section_image = computed(() => {
    return form.remove_find_us_page_section_image ? null : form.find_us_page_section_image ?? props.find_us_page_section_image
})

function submit() {
    form.post(route('edit.findus.update'))
}
</script>

<template>
    <Head title="Edit your Find Us page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Find Us page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header and a body paragraph telling potential customers how they can find your property and what they should do when they arrive. This can be however long you want, although if you want to add directions from specific places these should consider splitting them into individual directions listings.
                </p>
                <LabelledInputPair
                    v-model="form.find_us_page_section_header"
                    label="Page header"
                    placeholder="How to find our property"
                    :errorMessage="form.errors.find_us_page_section_header"
                    fieldID="find_us_page_section_header"
                    required
                />

                <InputLabel
                    for="find_us_page_section_paragraph"
                    value="Find Us paragraph"
                    class="sr-only"
                />
                <textarea
                    id="find_us_page_section_paragraph"
                    type="text"
                    v-model="form.find_us_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    required
                    autocomplete="find_us_page_section_paragraph"
                    placeholder="Our property can be found by..."
                />
                <InputError :message="form.errors.find_us_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <ImageInput
                    v-model="form.find_us_page_section_image"
                    :currentImage="find_us_page_section_image"
                    :errorMessage="form.errors.find_us_page_section_image"
                    fieldTitle="section image"
                    fieldID="find_us_page_section_image"
                    v-model:removeCurrentImage="form.remove_find_us_page_section_image"
                    :originalImage="props.find_us_page_section_image"
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
