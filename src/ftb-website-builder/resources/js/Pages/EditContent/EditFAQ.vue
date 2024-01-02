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

const faq_page_section_image = computed(() => {
    return form.remove_faq_page_section_image ? null : form.faq_page_section_image ?? props.faq_page_section_image
})

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
                <InputLabel
                    for="faq_page_section_header"
                    value="Page header"
                    class="sr-only"
                />
                <TextInput
                    id="faq_page_section_header"
                    type="text"
                    v-model="form.faq_page_section_header"
                    required
                    autocomplete="faq_page_section_header"
                    placeholder="Hear from our guests"
                />
                <InputError :message="form.errors.faq_page_section_header" />
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
                <FileInput
                    v-model="form.faq_page_section_image"
                    field-name="faq_page_section_image"
                />
                <InputError :message="form.errors.faq_page_section_image" />
                <ImagePreview
                    v-model="faq_page_section_image"
                    field-title="section image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_faq_page_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_faq_page_section_image && (props.faq_page_section_image || form.faq_page_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.faq_page_section_image || form.faq_page_section_image">
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
