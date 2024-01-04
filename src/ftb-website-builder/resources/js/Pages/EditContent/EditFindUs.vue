<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";

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
                    :modelValue="form.find_us_page_section_image"
                    :currentImage="find_us_page_section_image"
                    :errorMessage="form.errors.find_us_page_section_image"
                    fieldTitle="section image"
                    fieldID="find_us_page_section_image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_find_us_page_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_find_us_page_section_image && (props.find_us_page_section_image || form.find_us_page_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.find_us_page_section_image || form.find_us_page_section_image">
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
