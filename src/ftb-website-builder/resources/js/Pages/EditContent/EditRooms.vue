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
    rooms_page_section_header: String,
    rooms_page_section_paragraph: String,
    rooms_page_section_image: String,
});

const form = useForm({
    rooms_page_section_header: props.rooms_page_section_header,
    rooms_page_section_paragraph: props.rooms_page_section_paragraph,
    rooms_page_section_image: null,
    remove_rooms_page_section_image: false,
});

const rooms_page_section_image = computed(() => {
    return form.remove_rooms_page_section_image ? null : form.rooms_page_section_image ?? props.rooms_page_section_image
})

function submit() {
    form.post(route('edit.rooms.update'))
}
</script>

<template>
    <Head title="Edit rooms page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Rooms page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a header to sit at the top of your Rooms page. Optionally, you can write a body paragraph giving potential customers an overview of the rooms you have available. This can be however long you want, although detailed information about each room would work better as room descriptions.
                </p>
                <InputLabel
                    for="rooms_page_section_header"
                    value="Page header"
                    class="sr-only"
                />
                <TextInput
                    id="rooms_page_section_header"
                    type="text"
                    v-model="form.rooms_page_section_header"
                    required
                    autocomplete="rooms_page_section_header"
                    placeholder="Our Rooms"
                />
                <InputError :message="form.errors.rooms_page_section_header" />
                <InputLabel
                    for="rooms_page_section_paragraph"
                    value="Rooms paragraph"
                    class="sr-only"
                />
                <textarea
                    id="rooms_page_section_paragraph"
                    type="text"
                    v-model="form.rooms_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    required
                    autocomplete="rooms_page_section_paragraph"
                    placeholder="Our rooms are..."
                />
                <InputError :message="form.errors.rooms_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <FileInput
                    v-model="form.rooms_page_section_image"
                    field-name="rooms_page_section_image"
                />
                <InputError :message="form.errors.rooms_page_section_image" />
                <ImagePreview
                    v-model="rooms_page_section_image"
                    field-title="section image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_rooms_page_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_rooms_page_section_image && (props.rooms_page_section_image || form.rooms_page_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.rooms_page_section_image || form.rooms_page_section_image">
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