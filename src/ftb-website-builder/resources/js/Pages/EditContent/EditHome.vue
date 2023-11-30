<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";

const props = defineProps({
    currentCoverImagePrimary: String,
    currentIntroSectionHeader: String,
    currentIntroSectionParagraph: String,
    currentIntroSectionImage: String,
    currentWelcomeSectionHeader: String,
    currentWelcomeSectionParagraph: String,
    currentWelcomeSectionImage: String,
});

const form = useForm({
    cover_image_primary: null,
    intro_section_header: props.currentIntroSectionHeader,
    intro_section_paragraph: props.currentIntroSectionParagraph,
    intro_section_image: null,
    remove_intro_section_image: false,
    welcome_section_header: props.currentWelcomeSectionHeader,
    welcome_section_paragraph: props.currentWelcomeSectionParagraph,
    welcome_section_image: null,
    remove_welcome_section_image: false,
});

const coverImagePrimary = computed(() => {
    return form.cover_image_primary ?? props.currentCoverImagePrimary
})
const introSectionImage = computed(() => {
    return form.remove_intro_section_image ? null : form.intro_section_image ?? props.currentIntroSectionImage
})
const welcomeSectionImage = computed(() => {
    return form.welcome_section_image ?? props.currentWelcomeSectionImage
})

function submit() {
    form.post(route('edit.home.update'))
}
</script>

<template>
    <Head title="Edit" />
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
                <FileInput
                    v-model="form.cover_image_primary"
                    field-name="cover_image_primary"
                />
                <InputError :message="form.errors.cover_image_primary" />
                <ImagePreview
                    v-model="coverImagePrimary"
                    field-title="cover image"
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write an attention grabbing tag-line, and then a brief paragraph introducing your property. This should be no more than a few sentences long.
                </p>
                <InputLabel
                    for="intro_section_header"
                    value="Introduction header"
                    class="sr-only"
                />
                <TextInput
                    id="intro_section_header"
                    type="text"
                    v-model="form.intro_section_header"
                    required
                    autocomplete="intro_section_header"
                    placeholder="Introducing our property..."
                />
                <InputError :message="form.errors.intro_section_header" />
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
                <FileInput
                    v-model="form.intro_section_image"
                    field-name="intro_section_image"
                />
                <InputError :message="form.errors.intro_section_image" />
                <ImagePreview
                    v-model="introSectionImage"
                    field-title="introduction image"
                />
                <label class="wb-secondary-button ml-2">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_intro_section_image"
                        class="hidden"
                    />
                    <span v-if="form.remove_intro_section_image">
                        Use saved image
                    </span>
                    <span v-else-if="props.currentIntroSectionImage">
                        Remove current image
                    </span>
                </label>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Write a longer description to welcome the user to your website and tell them why they should make a booking with your property. This should be no more than a few paragraphs long.
                </p>
                <InputLabel
                    for="welcome_section_header"
                    value="Welcome header"
                    class="sr-only"
                />
                <TextInput
                    id="welcome_section_header"
                    type="text"
                    v-model="form.welcome_section_header"
                    required
                    autocomplete="welcome_section_header"
                    placeholder="Welcome to our property..."
                />
                <InputError :message="form.errors.welcome_section_header" />
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
                <FileInput
                    v-model="form.welcome_section_image"
                    field-name="welcome_section_image"
                />
                <InputError :message="form.errors.welcome_section_image" />
                <ImagePreview
                    v-model="welcomeSectionImage"
                    field-title="welcome image"
                />
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
