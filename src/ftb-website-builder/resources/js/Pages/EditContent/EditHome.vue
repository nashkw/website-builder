<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";

const props = defineProps({
    cover_image_primary: String,
    intro_section_header: String,
    intro_section_paragraph: String,
    intro_section_image: String,
    welcome_section_header: String,
    welcome_section_paragraph: String,
    welcome_section_image: String,
});

const form = useForm({
    cover_image_primary: null,
    intro_section_header: props.intro_section_header,
    intro_section_paragraph: props.intro_section_paragraph,
    intro_section_image: null,
    remove_intro_section_image: false,
    welcome_section_header: props.welcome_section_header,
    welcome_section_paragraph: props.welcome_section_paragraph,
    welcome_section_image: null,
    remove_welcome_section_image: false,
});

const cover_image_primary = computed(() => {
    return form.cover_image_primary ?? props.cover_image_primary
});
const intro_section_image = computed(() => {
    return form.remove_intro_section_image ? null : form.intro_section_image ?? props.intro_section_image
});
const welcome_section_image = computed(() => {
    return form.remove_welcome_section_image ? null : form.welcome_section_image ?? props.welcome_section_image
});

function submit() {
    form.post(route('edit.home.update'))
}
</script>

<template>
    <Head title="Edit your Home page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Home page
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Upload a cover image for your website.
                </p>
                <ImageInput
                    :modelValue="form.cover_image_primary"
                    :currentImage="cover_image_primary"
                    :errorMessage="form.errors.cover_image_primary"
                    fieldTitle="cover image"
                    fieldID="cover_image_primary"
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write an attention grabbing tag-line, and then a brief paragraph introducing your property. This should be no more than a few sentences long.
                </p>
                <LabelledInputPair
                    v-model="form.intro_section_header"
                    label="Introduction header"
                    placeholder="Introducing our property..."
                    :errorMessage="form.errors.intro_section_header"
                    fieldID="intro_section_header"
                    required
                />

                <InputLabel
                    for="intro_section_paragraph"
                    value="Introduction paragraph"
                    class="sr-only"
                />
                <textarea
                    id="intro_section_paragraph"
                    type="text"
                    v-model="form.intro_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    required
                    autocomplete="intro_section_paragraph"
                    placeholder="Our property is..."
                />
                <InputError :message="form.errors.intro_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this introduction.
                </p>
                <ImageInput
                    :modelValue="form.intro_section_image"
                    :currentImage="intro_section_image"
                    :errorMessage="form.errors.intro_section_image"
                    fieldTitle="introduction image"
                    fieldID="intro_section_image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_intro_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_intro_section_image && (props.intro_section_image || form.intro_section_image)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.intro_section_image || form.intro_section_image">
                        Remove current image
                    </span>
                </label>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a longer description to welcome the user to your website and tell them why they should make a booking with your property. This should be no more than a few paragraphs long.
                </p>
                <LabelledInputPair
                    v-model="form.welcome_section_header"
                    label="Welcome header"
                    placeholder="Welcome to our property..."
                    :errorMessage="form.errors.welcome_section_header"
                    fieldID="intro_section_header"
                    required
                />

                <InputLabel
                    for="welcome_section_paragraph"
                    value="Welcome paragraph"
                    class="sr-only"
                />
                <textarea
                    id="welcome_section_paragraph"
                    type="text"
                    v-model="form.welcome_section_paragraph"
                    class="wb-input-box h-60 s:h-40"
                    required
                    autocomplete="welcome_section_paragraph"
                    placeholder="Here at our property we..."
                />
                <InputError :message="form.errors.welcome_section_paragraph" />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to accompany this description.
                </p>
                <ImageInput
                    :modelValue="form.welcome_section_image"
                    :currentImage="welcome_section_image"
                    :errorMessage="form.errors.welcome_section_image"
                    fieldTitle="welcome image"
                    fieldID="welcome_section_image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_welcome_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_welcome_section_image && (props.welcome_section_image || form.welcome_section_image)">
                        No image selected - use saved image?
                    </span>
                    <span v-else-if="props.welcome_section_image || form.welcome_section_image">
                        Remove current image
                    </span>
                </label>
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
