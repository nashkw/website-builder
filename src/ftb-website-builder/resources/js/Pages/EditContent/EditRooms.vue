<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";

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

function submit() {
    form.post(route('edit.rooms.update'))
}
</script>

<template>
    <Head title="Edit your Rooms page" />
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
                <LabelledInputPair
                    v-model="form.rooms_page_section_header"
                    label="Page header"
                    placeholder="Our Rooms"
                    :errorMessage="form.errors.rooms_page_section_header"
                    fieldID="rooms_page_section_header"
                    required
                />

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
                    autocomplete="rooms_page_section_paragraph"
                    placeholder="Our rooms are..."
                />
                <InputError :message="form.errors.rooms_page_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this section.
                </p>
                <ImageInput
                    v-model="form.rooms_page_section_image"
                    :errorMessage="form.errors.rooms_page_section_image"
                    fieldTitle="section image"
                    fieldID="rooms_page_section_image"
                    v-model:removeCurrentImage="form.remove_rooms_page_section_image"
                    :originalImage="props.rooms_page_section_image"
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
