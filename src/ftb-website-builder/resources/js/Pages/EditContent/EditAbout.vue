<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";

const props = defineProps({
    about_page_section_header: String,
    about_page_section_paragraph: String,
    about_page_section_image: String,
    about_page_section_image_description: String,
});

const form = useForm({
    about_page_section_header: props.about_page_section_header,
    about_page_section_paragraph: props.about_page_section_paragraph,
    about_page_section_image: null,
    remove_about_page_section_image: false,
    about_page_section_image_description: props.about_page_section_image_description,
});

const about_page_section_image = computed(() => {
    return form.remove_about_page_section_image ? null : form.about_page_section_image ?? props.about_page_section_image
})

function submit() {
    form.post(route('edit.about.update'))
}
</script>

<template>
    <Head title="Edit about page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your About page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header and a body paragraph telling customers all about your property. This can be however long you want, although if you write more than a few paragraphs you should consider splitting them into multiple sections.
                </p>
                <InputLabel
                    for="about_page_section_header"
                    value="Page header"
                    class="sr-only"
                />
                <TextInput
                    id="about_page_section_header"
                    type="text"
                    v-model="form.about_page_section_header"
                    required
                    autocomplete="about_page_section_header"
                    placeholder="Our Story"
                />
                <InputError :message="form.errors.about_page_section_header" />
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

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <FileInput
                    v-model="form.about_page_section_image"
                    field-name="about_page_section_image"
                />
                <InputError :message="form.errors.about_page_section_image" />
                <ImagePreview
                    v-model="about_page_section_image"
                    field-title="section image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_about_page_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_about_page_section_image && (props.about_page_section_image || form.about_page_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.about_page_section_image || form.about_page_section_image">
                        Remove current image
                    </span>
                </label>
            </div>

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="wb-primary-button"
                >
                    Save
                </button>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="wb-text"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
