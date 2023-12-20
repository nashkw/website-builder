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
    <Head title="Edit explore page" />
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
                <InputLabel
                    for="explore_page_section_header"
                    value="Page header"
                    class="sr-only"
                />
                <TextInput
                    id="explore_page_section_header"
                    type="text"
                    v-model="form.explore_page_section_header"
                    required
                    autocomplete="explore_page_section_header"
                    placeholder="Our Story"
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
                    required
                    autocomplete="explore_page_section_paragraph"
                    placeholder="All explore our property..."
                />
                <InputError :message="form.errors.explore_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <FileInput
                    v-model="form.explore_page_section_image"
                    field-name="explore_page_section_image"
                />
                <InputError :message="form.errors.explore_page_section_image" />
                <ImagePreview
                    v-model="explore_page_section_image"
                    field-title="section image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_explore_page_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_explore_page_section_image && (props.explore_page_section_image || form.explore_page_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.explore_page_section_image || form.explore_page_section_image">
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
