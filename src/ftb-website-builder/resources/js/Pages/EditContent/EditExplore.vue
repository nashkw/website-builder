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
    explore_page_section_header: String,
    explore_page_section_paragraph: String,
    explore_page_section_image: String,
});

const form = useForm({
    explore_page_section_header: props.explore_page_section_header,
    explore_page_section_paragraph: props.explore_page_section_paragraph,
    explore_page_section_image: null,
    remove_explore_page_section_image: false,
});

const explore_page_section_image = computed(() => {
    return form.remove_explore_page_section_image ? null : form.explore_page_section_image ?? props.explore_page_section_image
})

function submit() {
    form.post(route('edit.explore.update'))
}
</script>

<template>
    <Head title="Edit your Explore page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Explore page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header to sit at the top of your explore page. Optionally, you can write a body paragraph telling customers what they can do while they stay at your property. This can be however long you want, although detailed information about each attraction would work better as attraction descriptions.
                </p>
                <LabelledInputPair
                    v-model="form.explore_page_section_header"
                    label="Page header"
                    placeholder="Things to do"
                    :errorMessage="form.errors.explore_page_section_header"
                    fieldID="explore_page_section_header"
                    required
                />

                <InputError :message="form.errors.explore_page_section_header" />
                <InputLabel
                    for="explore_page_section_paragraph"
                    value="Explore paragraph"
                    class="sr-only"
                />
                <textarea
                    id="explore_page_section_paragraph"
                    type="text"
                    v-model="form.explore_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    autocomplete="explore_page_section_paragraph"
                    placeholder="All explore our property..."
                />
                <InputError :message="form.errors.explore_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <ImageInput
                    v-model="form.explore_page_section_image"
                    :currentImage="explore_page_section_image"
                    :errorMessage="form.errors.explore_page_section_image"
                    fieldTitle="section image"
                    fieldID="explore_page_section_image"
                    v-model:removeCurrentImage="form.remove_explore_page_section_image"
                    :originalImage="props.explore_page_section_image"
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
